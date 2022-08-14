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