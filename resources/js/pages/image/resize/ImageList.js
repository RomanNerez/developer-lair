import Observer from "../../../utils/Observer";

export const ON_REMOVE_IMAGE = 'remove-image'
export const ON_ADD_IMAGE = 'add-image'
export const ON_ACTIVE_IMAGE = 'active-image'

class ImageList extends Observer {
  images = []
  activeImage = null

  getFirstImage() {
    return this.images[0]
  }

  addImage(image) {
    image.id += this.images.length
    this.images.push(image)
    this.dispatch(ON_ADD_IMAGE, image)
  }

  removeImage(image) {
    this.images = this.images.filter((imageItem) => imageItem !== image)
    this.dispatch(ON_REMOVE_IMAGE, image)
  }

  setActiveImage(image) {
    this.activeImage = image
    this.dispatch(ON_ACTIVE_IMAGE, image)
  }

  getActiveImage() {
    return this.activeImage
  }

  isActiveImage(image) {
    return this.activeImage === image
  }
}

export default new ImageList()