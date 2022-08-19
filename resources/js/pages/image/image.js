import $ from "jquery"
require('bootstrap')
import axios from 'axios'
import { fabric } from "fabric"
import { defaultDataElement } from "./defaultDataElement"
import { TEXTBOX_TYPE } from "./constants"
import UploadImageModal from "./UploadImageModal";
import { getNewWidthAndHeight } from "../../utils/helpers";
import {generateImage, previewImage} from "./method-api";

(function () {
  //===== Interface for Elements ========

  const elementX = $('#info-data-element #x')
  const elementY = $('#info-data-element #y')
  const elementWidth = $('#info-data-element #width')
  const elementHeight = $('#info-data-element #height')
  const elementAngle = $('#info-data-element #angle')
  const elementBackground = $('#info-data-element #background')

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
    },
    'selection:created': function () {
      $('#info-data-element').removeClass('d-none')
      setInfoDataElement()
    },
    'selection:updated': function () {
      setInfoDataElement()
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

      canvasFabric.add(element);
    }
  })

  $('#add-element .dropdown-menu a').each(function () {
    $(this).on('click', function () {
      const type = $(this).data('type')
      const initClass = defaultDataElement[type].initClass
      let element;
      if (defaultDataElement[type].text) {
        element = new initClass(defaultDataElement[type].text, defaultDataElement[type].defaultData)
      } else if (type === 'image') {
        UploadImageModal.show()
      } else {
        element = new initClass(defaultDataElement[type].defaultData)
      }
      if (!element) return
      canvasFabric.add(element);
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

  function initInfoDataElements() {
    const inputs = [
      elementX,
      elementY,
      elementWidth,
      elementHeight,
      elementAngle,
      elementBackground,
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

    if (![TEXTBOX_TYPE].includes(activeObject.get('type'))) return

    setInfoDataForTextElement(activeObject)
  }

  function setInfoDataForTextElement(activeObject) {
    elementLineHeight.val(activeObject.lineHeight)
    elementTextAlign.val(activeObject.textAlign)
    elementFontFamily.val(activeObject.fontFamily)
      console.log(activeObject)
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
      angle: parseFloat(elementAngle.val()),
      fill: elementBackground.val()
    }

    activeObject.setOptions(data)

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
    removeElementButton.on('click', function () {
      const activeObject = canvasFabric.getActiveObject()
      canvasFabric.remove(activeObject)
    })
  }

  init()
})()