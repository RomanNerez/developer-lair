import { fabric } from "fabric";

export const defaultDataElement = {
  rect: {
    defaultData: {
      id: +new Date(),
      width: 20,
      height: 30,
      fill: '#0000ff',
      left: 50,
      top: 50,
      padding: 0,
      margin: 0,
      backgroundColor: '#ffffff',
    },
    initClass: fabric.Rect
  },
  circle: {
    defaultData: {
      id: +new Date(),
      radius: 20,
      fill: '#008000',
      left: 100,
      top: 100,
      backgroundColor: '#ffffff',
    },
    initClass: fabric.Circle
  },
  triangle: {
    defaultData: {
      id: +new Date(),
      width: 100,
      height: 100,
      fill: '#0000ff',
      left: 50,
      top: 50,
      backgroundColor: '#ffffff',
    },
    initClass: fabric.Triangle
  },
  image: {
    defaultData: {
      id: +new Date(),
      left: 100,
      top: 100,
      height: 100,
      width: 100,
      opacity: 1,
      backgroundColor: '#ffffff',
      fill: '#000000',
    },
    getImage: function () {

    },
    initClass: fabric.Image,
  },
  text: {
    defaultData: {
      id: +new Date(),
      lineHeight: 1,
      textAlign: 'center',
      fontFamily: 'Roboto',
      backgroundColor: '#ffffff',
      fill: '#000000',
    },
    text: 'Text',
    initClass: fabric.Textbox
  }
}