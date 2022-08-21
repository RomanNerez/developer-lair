import $ from "jquery"
require('bootstrap')
import axios from 'axios'
import { fabric } from "fabric"
import { defaultDataElement } from "./defaultDataElement"
import {
  TEXTBOX_TYPE,
  TYPE_ACTION_BLOCK_OBJECT,
  TYPE_ACTION_REMOVE_OBJECT,
  TYPE_ACTION_VISIBILITY_OBJECT
} from "./constants"
import UploadImageModal from "./UploadImageModal";
import {capitalizeFirstLetter, getNewWidthAndHeight} from "../../utils/helpers";
import {generateImage, previewImage} from "./method-api";

(function () {
  //===== Interface for Elements ========

  const elementX = $('#info-data-element #x')
  const elementY = $('#info-data-element #y')
  const elementWidth = $('#info-data-element #width')
  const elementHeight = $('#info-data-element #height')
  const elementAngle = $('#info-data-element #angle')
  const elementBackground = $('#info-data-element #background')
  const elementFill = $('#info-data-element #fill')

  const elementLineHeight = $('#info-data-element #line-height')
  const elementTextAlign = $('#info-data-element #text-align')
  const elementFontFamily = $('#info-data-element #font-family')
  const removeElementButton = $('#remove-button')

//================================================

  const canvas = document.querySelector('#create-image')
  const canvasFabric = new fabric.Canvas(canvas, {
    width: 640,
    height: 360
  })

  // canvasFabric.setBackgroundColor({
  //   source: '/images/bg.png',
  //   repeat: 'repeat',
  //   id: 'test'
  // }, canvasFabric.renderAll.bind(canvasFabric));

  canvasFabric.on({
    'selection:cleared': function () {
      $('#info-data-element').addClass('d-none')
      setActiveItemOfList()
    },
    'selection:created': function () {
      $('#info-data-element').removeClass('d-none')
      setInfoDataElement()
      setActiveItemOfList()
    },
    'selection:updated': function () {
      setInfoDataElement()
      setActiveItemOfList()
    },
    'object:moving': function () {
      setInfoDataElement()
    },
    'object:scaling': function () {
      setInfoDataElement()
    },
    'object:skewing': function () {
      setInfoDataElement()
    },
    'object:resizing': function () {
      setInfoDataElement()
    },
    'object:rotating': function () {
      setInfoDataElement()
    }
  })

  function getAllData() {
      const fabricData = JSON.parse(JSON.stringify(canvasFabric))
      const objects = canvasFabric.getObjects()
      fabricData.objects.forEach((object, index) => object.boundingRect = objects[index].getBoundingRect())
      return {
          width: canvasFabric.getWidth(),
          height: canvasFabric.getHeight(),
          fabric_data: fabricData
      }
  }

  $('#generate').on('click', function () {
      const dataObject = getAllData()
      generateImage(dataObject)
      .then((response) => {
          const link = document.createElement('a');
          link.href = window.URL.createObjectURL(response.data);
          link.download = 'test.png';
          link.click();
      })
  });

  $('#preview-image').on('click', function () {
      const dataObject = getAllData()
      previewImage(dataObject)
      .then((response) => {
          $('#preview').attr('src', URL.createObjectURL(response))
      })
  })

  UploadImageModal.setCallbackUploadedImage(function (data) {
    const initClass = defaultDataElement.image.initClass
    const image = new Image()
    image.src = data.url
    image.onload = function (event) {
      const element = new initClass(image);
      const { width, height } = getNewWidthAndHeight(
        image.width,
        image.height,
        canvasFabric.getWidth(),
        canvasFabric.getHeight()
      )
      
      element.scaleToWidth(width)
      element.scaleToHeight(height)
      element.id = +new Date()

      canvasFabric.add(element);
      updateListObjects()
    }
  })

  $('#add-element .dropdown-menu a').each(function () {
    $(this).on('click', function () {
      const type = $(this).data('type')
      const initClass = defaultDataElement[type].initClass
      defaultDataElement[type].defaultData.id = +new Date()
      let element;
      if (defaultDataElement[type].text) {
        element = new initClass(defaultDataElement[type].text, defaultDataElement[type].defaultData)
      } else if (type === 'image') {
        UploadImageModal.show()
      } else {
        element = new initClass(defaultDataElement[type].defaultData)
      }
      if (!element) return
      canvasFabric.add(element)
      updateListObjects()
    })
  })

  $('#change-size .dropdown-menu a').each(function () {
    $(this).on('click', function () {
      const width = $(this).data('width')
      const height = $(this).data('height')
      const type = $(this).data('type')

      if (type) {
        return
      }

      canvasFabric.setWidth(width)
      canvasFabric.setHeight(height)
    })
  })

  function updateListObjects() {
    const objects = canvasFabric.getObjects()
    const activeObject = canvasFabric.getActiveObject()
    const list = $('#list-object')
    list.empty()

    objects.forEach((object) => {
      const itemObject = $('#list-object-clone li').clone()
      itemObject.data('id', object.id)
      $('.title', itemObject).html(capitalizeFirstLetter(object.type))
      if (activeObject && activeObject.id === object.id) itemObject.addClass('active')
      initActionsItemOfListObject(itemObject)
      list.append(itemObject)
    })
  }

  function initActionsItemOfListObject(itemObject) {
    const actions = $('i', itemObject)
    const objectId = parseInt(itemObject.data('id'))
    const objects = canvasFabric.getObjects()
    const object = objects.find((object) => object.id === objectId)
    itemObject.click(function (event) {
      let isAction = false
      actions.each((index, item) => {
        if (isAction) return
        isAction = $(item).get(0) === event.target
      })
      if (isAction) return

      canvasFabric.setActiveObject(object)
      canvasFabric.renderAll()
    })

    actions.each(function (index, item) {
      const action = $(item)

      action.click(function() {
        if (action.data('action') === TYPE_ACTION_VISIBILITY_OBJECT) {
          action.toggleClass('fa-eye-slash')
          action.toggleClass('fa-eye')
          if (action.hasClass('fa-eye-slash')) {
            object.setOptions({
              visible: false,
            })
          } else {
            object.setOptions({
              visible: true,
            })
          }
          canvasFabric.renderAll()
        }
        if (action.data('action') === TYPE_ACTION_BLOCK_OBJECT) {
          action.toggleClass('fa-unlock')
          action.toggleClass('fa-lock')
          if (action.hasClass('fa-unlock')) {
            object.setOptions({
              selectable: true,
              evented: true
            })
          } else {
            object.setOptions({
              selectable: false,
              evented: false
            })
          }
        }
        if (action.data('action') === TYPE_ACTION_REMOVE_OBJECT) {
          canvasFabric.remove(object)
          updateListObjects()
        }
      })
    })
  }

  function setActiveItemOfList() {
    const activeObject = canvasFabric.getActiveObject()
    $('#list-object li').each(function () {
      $(this).removeClass('active')
      if (activeObject && $(this).data('id') === activeObject.id) {
        $(this).addClass('active')
      }
    })
  }

  function initInfoDataElements() {
    const inputs = [
      elementX,
      elementY,
      elementWidth,
      elementHeight,
      elementAngle,
      elementBackground,
      elementFill,
      elementLineHeight,
      elementTextAlign,
      elementFontFamily
    ]
    inputs.forEach((input) => {
      input.on('input', () => updateActiveElement())
    })
  }

  function setInfoDataElement() {
    const activeObject = canvasFabric.getActiveObject()
    const absoluteData = activeObject.getBoundingRect()

    elementX.val(absoluteData.left.toFixed(0))
    elementY.val(absoluteData.top.toFixed(0))
    elementWidth.val(absoluteData.width.toFixed(0))
    elementHeight.val(absoluteData.height.toFixed(0))
    elementAngle.val(activeObject.angle.toFixed(0))
    elementBackground.val(activeObject.backgroundColor)
    elementFill.val(activeObject.fill)
    if (![TEXTBOX_TYPE].includes(activeObject.get('type'))) return

    setInfoDataForTextElement(activeObject)
  }

  function setInfoDataForTextElement(activeObject) {
    elementLineHeight.val(activeObject.lineHeight)
    elementTextAlign.val(activeObject.textAlign)
    elementFontFamily.val(activeObject.fontFamily)
  }

  function updateActiveElement() {
    const activeObject = canvasFabric.getActiveObject()
    const data = {
      top: parseFloat(elementY.val()),
      left: parseFloat(elementX.val()),
      width: parseFloat(elementWidth.val()),
      height: parseFloat(elementHeight.val()),
      scaleX: 1,
      scaleY: 1,
      backgroundColor: elementBackground.val(),
      fill: elementFill.val()
    }

    activeObject.setOptions(data)
    activeObject.rotate(parseFloat(elementAngle.val()))

    if ([TEXTBOX_TYPE].includes(activeObject.get('type'))) {
      updateActiveElementText(activeObject)
    }

    canvasFabric.renderAll();
  }

  function updateActiveElementText(activeObject) {
    const data = {
      lineHeight: elementLineHeight.val(),
      textAlign: elementTextAlign.val(),
      fontFamily: elementFontFamily.val()
    }

    activeObject.setOptions(data)
  }

  function init() {
    initInfoDataElements()
  }

  init()
})()