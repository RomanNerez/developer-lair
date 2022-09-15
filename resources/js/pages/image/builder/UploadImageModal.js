import $ from "jquery";
import axios from "axios";


class UploadImageModal {

  elementFileInput = $('#upload-image #image-file')
  element = $('#upload-image')
  callback;

  constructor() {}

  getFiles() {
    return this.elementFileInput.prop('files')
  }

  clearFiles() {
    this.elementFileInput.val(null)
  }

  toggleLoading() {
    $('.modal-footer button[data-action="add-image"] span', this.element).toggleClass('d-none')
    $('.modal-footer button[data-action="add-image"] div', this.element).toggleClass('d-none')
  }

  upload() {
    this.toggleLoading()
    const formData = new FormData()
    const file = this.getFiles()

    formData.append('image', file[0])

    axios.post('/image/upload', formData)
      .then((res) => {
        this.callback({
          status: res.status,
          url: res.data.url
        })
        this.hide()
        this.clearFiles()
      })
      .catch((err) => {
        this.callback({
          status: err,
          url: false
        })
      })
      .finally(() => {
        this.toggleLoading()
      })
  }

  show() {
    this.element.modal('show')
    $('.modal-footer button[data-action="add-image"]', this.element).on('click', this.upload.bind(this))
  }

  hide() {
    this.element.modal('hide')
    $('.modal-footer button[data-action="add-image"]', this.element).off('click')
  }

  setCallbackUploadedImage(callback) {
    this.callback = callback
  }
}

export default new UploadImageModal()