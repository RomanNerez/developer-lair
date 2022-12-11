import $ from "jquery"
import CropperImage, { ON_READY_CROPPER, ON_CROP_MOVE } from "./CropperImage";
import ControlSettings, { ON_CHANGE_INPUTS } from "./ControlSettings";
import ImageList, { ON_ADD_IMAGE } from "./ImageList";
import ImageElement from "./ImageElement";
import 'cropperjs/dist/cropper.min.css'
import '@splidejs/splide/dist/css/splide.min.css';
import Splide from '@splidejs/splide';
import getSlide from "./templates/slide-item";
import axios from "axios";

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
    const inputValue = event.value
    const cropperValue = event.valueCropper
    cropperImage.setCropBoxData({ [event.action]: cropperValue })
    const data = cropperImage.getCropBoxData()
    if (inputValue >= 0 && (cropperValue <= data[event.action])) {
      delete data[event.action]
    }

    controlSettings.setInputData(data)
  })

  cropperImage.on(ON_CROP_MOVE, function () {
    controlSettings.setInputData(cropperImage.getCropBoxData())
  })

  cropperImage.on(ON_READY_CROPPER, function () {
    controlSettings.setInputData(cropperImage.getCropBoxData())
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
      controlSettings.setImage(ImageList.getFirstImage())

      new Splide( '.splide', {
        perPage: 3,
        focus: 'center',
        rewind : true,
      }).mount();

      $(event.target).prop('files', null)
      $(event.target).val(null)
      this.toggleSections()
    },

    async onPushImages(event) {
      const formData = new FormData()
      ImageList.images.forEach((image, index) => {

        formData.append(`images[${index}][file]`, image.file)
        formData.append(`images[${index}][width]`, image.inputData.width || image.width)
        formData.append(`images[${index}][height]`, image.inputData.height || image.height)
        formData.append(`images[${index}][x]`, image.inputData.left)
        formData.append(`images[${index}][y]`, image.inputData.top)
      })

      const { data } = await axios.post('/image/crop/cropping', formData)
      window.location = `${window.location.origin}/image/share/${data.uuid}`
    },

    initOnClickSlide() {
      $('li', splideList).on('click', function () {
        const imageId = parseInt($(this).data('image-id'))
        const imageElement = ImageList.getImageById(imageId)
        cropperImage.setImage(imageElement)
        controlSettings.setImage(imageElement)
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