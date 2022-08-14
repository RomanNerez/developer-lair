import { fabric } from "fabric";

export const defaultDataElement = {
  rect: {
    defaultData: {
      width: 20,
      height: 30,
      fill: 'blue',
      left: 50,
      top: 50,
      padding: 0
    },
    initClass: fabric.Rect
  },
  circle: {
    defaultData: {
      radius: 20,
      fill: 'green',
      left: 100,
      top: 100,
    },
    initClass: fabric.Circle
  },
  triangle: {
    defaultData: {
      width: 20,
      height: 30,
      fill: 'blue',
      left: 50,
      top: 50,
    },
    initClass: fabric.Triangle
  },
  image: {
    defaultData: {
      left: 100,
      top: 100,
      height: 100,
      width: 100,
      opacity: 1
    },
    getImage: function () {

    },
    initClass: fabric.Image,
  },
  text: {
    defaultData: {
      lineHeight: 1,
      textAlign: 'center',
      fontFamily: 'Roboto'
    },
    text: 'Text',
    initClass: fabric.Textbox
  }
}