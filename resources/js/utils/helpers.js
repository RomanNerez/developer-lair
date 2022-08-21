export function getNewWidthAndHeight(currentWidth, currentHeight, toWidth, toHeight) {
  const currentRatio = currentWidth / currentHeight
  const toRatio = toWidth / toHeight
  let width;
  let height;

  if (currentRatio < toRatio) {
    width = currentWidth / (toRatio / currentRatio)
    height = toHeight
  } else if (toRatio < currentRatio) {
    width = toWidth
    height = currentHeight / (currentRatio / toRatio)
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