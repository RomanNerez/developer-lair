export default function getSlide(imageId, url) {
  return `<li class="splide__slide text-center" data-image-id="${imageId}">
                <div style="max-width: 200px; height: 100%; margin: auto; display: flex;">
                    <img style="max-width: 100%; max-height: 100%; object-fit: contain" src="${url}">
                </div>
              </li>`
}