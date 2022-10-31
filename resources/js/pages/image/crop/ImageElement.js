import Observer from "../../../utils/Observer";

class ImageElement extends Observer {

  width = 0
  height = 0
  id = +new Date()
  file = null
  url = null
  cropBoxData = null

  constructor(fileName, file) {
    super();
    this.file = file
    this.url = this.getUrlFile(file)
  }

  getId() {
    return this.id
  }

  getUrlFile(file) {
    return URL.createObjectURL(file)
  }

  getUrl() {
    return this.url
  }

  setCropBoxData(data) {
    this.cropBoxData = data
  }

  setSize(width, height) {
    this.width = width
    this.height = height
  }
}

export default ImageElement