class ImageElements {
  images = []
  callback

  addImage(image) {
    this.images.push(image)
  }

  removeImage(image) {
    this.images = this.images.filter((imageItem) => imageItem !== image)
  }

  render() {
    this.images.forEach((image) => this.callback(image))
  }

  setCallback(callback) {
    this.callback = callback
  }

}

export default new ImageElements()