export default class ImageElement {
  fileName = null
  id = +new Date()
  angel = 0
  file

  constructor(fileName, file) {
    this.fileName = fileName
    this.file = file
    this.url = this.getUrlFile(file)
  }

  setAngel(newAngel) {
    this.angel = newAngel
    if (Math.abs(this.angel) >= 360) this.angel = 0
  }

  rotateRight() {
    this.setAngel(this.angel - 90)
  }

  rotateLeft() {
    this.setAngel(this.angel + 90)
  }

  getFileName () {
    return this.fileName
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