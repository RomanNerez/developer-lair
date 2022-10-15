import $ from "jquery"
import ImageElement, { ON_ROTATE } from "./ImageElement"
import ImageList, { ON_ADD_IMAGE , ON_REMOVE_IMAGE} from "./ImageList";
import getCardImage from "./templates/card-image";
import axios from "axios";

(function () {

  const imageList = $('#image-list'),
        uploadInput = $('#upload_input'),
        selectFile = $('.select-file'),
        wrapContainer = $('.wrap-container'),
        buttonsIntoContent = $('.content button'),
        downloadButton = $('#download')

  const rotatePage = {
    init() {
      $('#upload').click(function () {
        uploadInput.trigger('click')
      })

      uploadInput.change((event) => this.loadFiles(event))
    },

    loadFiles(event) {
      const files = Array.prototype.slice.call(event.target.files)
      files.forEach(function (file) {
        ImageList.addImage(new ImageElement(file.name, file))
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

      image.on(ON_ROTATE, (image) => {
        $('img', cardClone).css('transform', `rotate(${image.getAngel()}deg)`)
      })

      $('.action .rotate-right', cardClone).click(() => image.rotateRight())
      $('.action .rotate-left', cardClone).click(() => image.rotateLeft())
      $('.action .delete-card', cardClone).click(() => ImageList.removeImage(image))

      imageList.append(cardClone)
    },

    removeImageCard(image) {
      imageList.find(`[data-id="${image.getId()}"]`).remove()
      if (!ImageList.images.length) {
        this.toggleSections()
      }
    },

    download() {
      const formData = new FormData()

      ImageList.images.forEach((image, index) => {
        formData.append(`images[${index}][angel]`, image.angel)
        formData.append(`images[${index}][file]`, image.file)
      })

      axios.post('/image/rotate/rotate-download', formData, {
        headers: {
          "Content-Type": "multipart/form-data"
        },
        responseType: "blob"
      }).then((response) => {
        const a = document.createElement('a')
        a.download = response.headers.filename
        a.href = URL.createObjectURL(response.data)
        a.click()
        a.remove()
      })
    }
  }

  ImageList.on(ON_ADD_IMAGE, (image) => rotatePage.addImageCard(image))
  ImageList.on(ON_REMOVE_IMAGE, (image) => rotatePage.removeImageCard(image))

  buttonsIntoContent.each(function (index, element) {
    $(element).on('click', function () {
      const action = $(this).data('action')
      if (action === 'rotate-left') ImageList.rotateLeftAll()
      if (action === 'rotate-right') ImageList.rotateRightAll()
      if (action === 'reset') ImageList.resetRotateAll()
    })
  })

  downloadButton.on('click', function () {
    rotatePage.download()
  })

  $(document).ready(function () {
    rotatePage.init()
  })

})()

