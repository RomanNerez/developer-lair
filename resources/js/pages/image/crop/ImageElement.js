import Observer from "../../../utils/Observer";

class ImageElement extends Observer {


  width = 0
  height = 0
  id = +new Date()
  file = null
  url = null
  cropBoxData = null
  containerData = null
  inputData = {
    left: 0,
    top: 0,
    width: 0,
    height: 0
  }

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

  setContainerData(data) {
    this.containerData = data
  }

  setSize(width, height) {
    this.width = width
    this.height = height
  }

  setInputData(key, value) {
    this.inputData = {
      ...this.inputData,
      [key]: value
    }
  }

  getSize() {
    return { width: this.width, height: this.height }
  }
}

export default ImageElement