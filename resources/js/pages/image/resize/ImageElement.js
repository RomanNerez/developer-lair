import Observer from "../../../utils/Observer";

export const ON_ROTATE = 'rotate'

class ImageElement extends Observer {
  width = 0
  height = 0
  fileName = null
  id = +new Date()
  file = null
  extension = null
  url = null

  constructor(fileName, file) {
    super();
    const fileNameData = fileName.split('.')
    this.fileName = fileNameData[0]
    this.extension = fileNameData[1]
    this.file = file
    this.url = this.getUrlFile(file)
  }

  getFileName () {
    return this.fileName
  }

  getFullFileName() {
    return `${this.fileName}.${this.extension}`
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

  setSize(width, height) {
    this.width = width
    this.height = height
  }

  getSize() {
    return { width: this.width, height: this.height }
  }
}

export default ImageElement