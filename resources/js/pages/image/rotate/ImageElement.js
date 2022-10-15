import Observer from "../../../utils/Observer";

export const ON_ROTATE = 'rotate'

class ImageElement extends Observer {
  fileName = null
  id = +new Date()
  angel = 0
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

  setAngel(newAngel) {
    this.angel = newAngel
    if (Math.abs(this.angel) >= 360) this.angel = 0
    this.dispatch(ON_ROTATE, this)
  }

  rotateRight() {
    this.setAngel(this.angel - 90)
    this.dispatch(ON_ROTATE, this)
  }

  rotateLeft() {
    this.setAngel(this.angel + 90)
    this.dispatch(ON_ROTATE, this)
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

  getAngel() {
    return this.angel
  }

  getUrlFile(file) {
    return URL.createObjectURL(file)
  }

  getUrl() {
    return this.url
  }
}

export default ImageElement