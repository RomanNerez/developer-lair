import $ from "jquery";

const elementX = $('#info-data-element #x')
const elementY = $('#info-data-element #y')
const elementWidth = $('#info-data-element #width')
const elementHeight = $('#info-data-element #height')
const elementAngle = $('#info-data-element #angle')
const elementLineHeight = $('#info-data-element #line-height')
const elementTextAlign = $('#info-data-element #text-align')
const elementFontFamily = $('#info-data-element #font-family')
const removeElementButton = $('#remove-button')


export default class NavBarControl {

  storage = {}

  constructor(inputs) {
    inputs.forEach(() => {

    })
  }


  on(event, callback) {
    if (!this.storage[event]) this.storage[event] = []

    this.storage[event].push(callback)
  }
}