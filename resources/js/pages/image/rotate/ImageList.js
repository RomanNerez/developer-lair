import Observer from "../../../utils/Observer";

export const ON_REMOVE_IMAGE = 'remove-image'
export const ON_ADD_IMAGE = 'add-image'

class ImageList extends Observer {
  images = []

  addImage(image) {
    image.id += this.images.length
    this.images.push(image)
    this.dispatch(ON_ADD_IMAGE, image)
  }

  removeImage(image) {
    this.images = this.images.filter((imageItem) => imageItem !== image)
    this.dispatch(ON_REMOVE_IMAGE, image)
  }

  rotateLeftAll() {
    this.images.forEach((image) => image.rotateLeft())
  }

  rotateRightAll() {
    this.images.forEach((image) => image.rotateRight())
  }

  resetRotateAll() {
    this.images.forEach((image) => image.setAngel(0))
  }

}

export default new ImageList()