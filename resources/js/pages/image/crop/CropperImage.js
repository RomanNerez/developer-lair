import Cropper from "cropperjs"
import Observer from "../../../utils/Observer";

export const ON_READY_CROPPER = 'ready-cropper'
export const ON_CROP_MOVE = 'crop-move'

export default class CropperImage extends Observer {

  url = null
  cropperInstance = null
  currentImageInstance = null
  imageElement = null
  $imageElement = null

  constructor(imageElement, $imageElement) {
    super()
    this.imageElement = imageElement
    this.$imageElement = $imageElement
  }

  setImage(image) {
    if (this.currentImageInstance === image) return
    this.currentImageInstance = image
    this.setUrl(image.getUrl())
  }

  setUrl(url = null) {
    this.url = url
    this.imageElement.onload = async () => {
      this.destroyCropper()
      const event = await this._initCropper()
      this._setCropBoxDataFromImage()
      this.dispatch(ON_READY_CROPPER, { event })
    }
    this.imageElement.src = url
  }

  _setCropBoxDataFromImage() {
    const cropBoxData = this.currentImageInstance.cropBoxData
    if (cropBoxData) {
      this.setCropBoxData(cropBoxData)
    }
  }

  getCropBoxData() {
    return this.cropperInstance.getCropBoxData()
  }

  setCropBoxData(data) {
    this.cropperInstance.setCropBoxData(data)
  }

  destroyCropper() {
    if (this.cropperInstance) {
      this.cropperInstance.destroy()
    }
  }

  _initCropper() {
    return new Promise((resolve, reject) => {
      this.cropperInstance = new Cropper(
        this.imageElement,
        {
          zoomable: false,
          ready(event) {
            resolve(event)
          },
          cropmove: (event) => {
            this.currentImageInstance.setCropBoxData(this.getCropBoxData())
            this.dispatch(ON_CROP_MOVE, event)
          }
        }
      )
    })
  }


}