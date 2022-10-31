import $ from "jquery"
import CropperImage, { ON_READY_CROPPER, ON_CROP_MOVE } from "./CropperImage";
import ControlSettings, { ON_CHANGE_INPUTS } from "./ControlSettings";
import ImageList, { ON_ADD_IMAGE } from "./ImageList";
import ImageElement from "./ImageElement";
import 'cropperjs/dist/cropper.min.css'
import '@splidejs/splide/dist/css/splide.min.css';
import Splide from '@splidejs/splide';
import getSlide from "./templates/slide-item";

(function () {
  const uploadInput = $('#upload_input'),
        selectFile = $('.select-file'),
        wrapContainer = $('.wrap-container'),
        image = $('.crop-container .image'),
        img = $('.crop-container img'),
        splideList = $('.splide__list'),
        controlNavbar = $('#control-navbar'),
        downloadButton = $('#download')

  const cropperImage = new CropperImage(img.get(0), img)
  const controlSettings = new ControlSettings(controlNavbar)

  controlSettings.on(ON_CHANGE_INPUTS, function (event) {
    cropperImage.setCropBoxData({ [event.action]: event.value })
  })

  cropperImage.on(ON_CROP_MOVE, function () {
    const { width, height, top, left } = cropperImage.getCropBoxData()
    controlSettings.setInputData({ width, height, y: top, x: left})
  })

  cropperImage.on(ON_READY_CROPPER, function () {
    const { width, height, top, left } = cropperImage.getCropBoxData()
    controlSettings.setInputData({ width, height, y: top, x: left})
  })

  ImageList.on(ON_ADD_IMAGE, function (image) {
    const $slideItem = $(getSlide(image.getId(), image.getUrl()))
    splideList.append($slideItem)
    const imageElement = $slideItem.find('img').get(0)
    imageElement.onload = function () {
      image.setSize(this.naturalWidth, this.naturalHeight)
    }
  })

  const cropPage = {
    init() {
      $('#upload').click(function () {
        uploadInput.trigger('click')
      })

      uploadInput.change((event) => this.loadFiles(event))
      downloadButton.click((event) => this.onPushImages(event))
    },

    loadFiles(event) {
      const files = Array.prototype.slice.call(event.target.files)
      files.forEach(function (file) {
        const imageElement = new ImageElement(file.name, file)
        ImageList.addImage(imageElement)
      })

      this.initOnClickSlide()

      cropperImage.setImage(ImageList.getFirstImage())

      new Splide( '.splide', {
        perPage: 3,
        focus: 'center',
        rewind : true,
      }).mount();

      $(event.target).prop('files', null)
      $(event.target).val(null)
      this.toggleSections()
    },

    onPushImages(event) {
      console.log(ImageList)
    },

    initOnClickSlide() {
      $('li', splideList).on('click', function () {
        const imageId = parseInt($(this).data('image-id'))
        cropperImage.setImage(ImageList.getImageById(imageId))
      })
    },

    toggleSections() {
      selectFile.toggleClass('d-none');
      wrapContainer.toggleClass('d-none')
    },
  }

  $(document).ready(function () {
    cropPage.init()
  })
})()