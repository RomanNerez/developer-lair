export function getNewWidthAndHeight(currentWidth, currentHeight, toWidth, toHeight) {
  const currentRatio = currentWidth / currentHeight
  const toRatio = toWidth / toHeight
  let width = toWidth;
  let height = toHeight;

  if (currentRatio < toRatio) {
    width = toWidth / (toRatio / currentRatio)
    height = toHeight
  } else if (toRatio < currentRatio) {
    width = toWidth
    height = toHeight / (currentRatio / toRatio)
  }

  return { width, height }
}

function componentToHex(c) {
    var hex = c.toString(16);
    return hex.length == 1 ? "0" + hex : hex;
}

export function rgbToHex(r, g, b) {
    return "#" + componentToHex(r) + componentToHex(g) + componentToHex(b);
}

export function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

export function getTypeByInputType(type, value) {
  switch (type) {
    case 'text':
      return String(value)
    case 'number':
      return Number(value)
    default:
      return value
  }
}