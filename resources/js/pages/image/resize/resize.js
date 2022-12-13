import $ from "jquery"
import ImageElement, { ON_ROTATE } from "./ImageElement"
import ImageList, {ON_ACTIVE_IMAGE, ON_ADD_IMAGE, ON_REMOVE_IMAGE} from "./ImageList";
import ControlSettings, { ON_CHANGE_INPUTS } from "./ControlSettings";
import getCardImage from "./templates/card-image";
import axios from "axios";

(function () {

  const imageList = $('#image-list'),
    uploadInput = $('#upload_input'),
    selectFile = $('.select-file'),
    wrapContainer = $('.wrap-container'),
    buttonsIntoContent = $('.content button'),
    controlNavbar = $('.navbar-left'),
    downloadButton = $('#download')

  const controlSettings = new ControlSettings(controlNavbar)
  controlSettings.on(ON_CHANGE_INPUTS, function (event) {
    const image = ImageList.getActiveImage()
    const size = { ...image.getSize(), [event.action]: event.value }
    image.setSize(size.width, size.height)
    const imageElement = imageList.find(`[data-id="${image.getId()}"]`)
    imageElement.find('.badge-success').text(`${image.width}x${image.height}`)
  })

  const resizePage = {
    init() {
      $('#upload').click(function () {
        uploadInput.trigger('click')
      })

      uploadInput.change((event) => this.loadFiles(event))
    },

    loadFiles(event) {
      const files = Array.prototype.slice.call(event.target.files)
      const promises = []
      files.forEach(function (file) {
        const promise = new Promise((resolve, reject) => {
          const image = new ImageElement(file.name, file)
          const imageElement = new Image()
          imageElement.onload = function () {
            image.setSize(this.width, this.height)
            resolve(image)
          }
          imageElement.src = image.getUrl()
        })
        promises.push(promise)
      })

      Promise.all(promises).then((res) => {
        res.forEach(image => ImageList.addImage(image))
        ImageList.setActiveImage(ImageList.getFirstImage())
      })

      $(event.target).prop('files', null)
      $(event.target).val(null)
      this.toggleSections()
    },

    toggleSections() {
      selectFile.toggleClass('d-none');
      wrapContainer.toggleClass('d-none')
    },

    addImageCard(image) {
      const cardClone = $(getCardImage(image))

      $('.action .delete-card', cardClone).click(() => ImageList.removeImage(image))
      $(cardClone).click(() => ImageList.setActiveImage(image))

      imageList.append(cardClone)
    },

    removeImageCard(image) {
      imageList.find(`[data-id="${image.getId()}"]`).remove()
      if (!ImageList.images.length) {
        this.toggleSections()
      }
      if (ImageList.isActiveImage(image)) {
        ImageList.setActiveImage(ImageList.getFirstImage())
      }
    },

    activeImageCard(image) {
      imageList.find('.card.active').removeClass('active')
      imageList.find(`[data-id="${image.getId()}"]`).find('.card').addClass('active')
      controlSettings.setInputData(image.getSize())
    },

    async onPushImage() {
      const formData = new FormData()

      ImageList.images.forEach((image, index) => {
        formData.append(`images[${index}][width]`, image.width)
        formData.append(`images[${index}][height]`, image.height)
        formData.append(`images[${index}][file]`, image.file)
      })

      const { data } = await axios.post('/image/resize/resizing', formData)
      window.location = `${window.location.origin}/image/share/${data.uuid}`
    }
  }

  ImageList.on(ON_ADD_IMAGE, (image) => resizePage.addImageCard(image))
  ImageList.on(ON_REMOVE_IMAGE, (image) => resizePage.removeImageCard(image))
  ImageList.on(ON_ACTIVE_IMAGE, (image) => resizePage.activeImageCard(image))

  downloadButton.on('click', function () {
    resizePage.onPushImage()
  })

  $(document).ready(function () {
    resizePage.init()
  })

})()

