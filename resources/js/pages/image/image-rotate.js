import $ from "jquery"
import ImageElement from "./rotate/ImageElement"
import ImageElements from "./rotate/ImageElements";

(function () {
  $(document).ready(function () {
    init()
    ImageElements.setCallback(renderImageCard)
  })

  function init() {
    $('#upload').click(function () {
      $('#upload_input').trigger('click')
    })

    $('#upload_input').change(loadFiles)
  }

  function loadFiles(event) {
    const files = Array.prototype.slice.call(event.target.files)
    files.forEach(function (file) {
      ImageElements.addImage(new ImageElement(file.name, file))
    })

    $('.select-file').addClass('d-none');
    $('.wrap-container').removeClass('d-none')
    ImageElements.render()
  }

  function renderImageCard(image) {
    const imageList = $('#image-list')
    const cardClone = $('#clone-card').clone()
    $('img', cardClone).attr('src', image.getUrl())
    $('img', cardClone).css('transform', `rotate(${image.getAngel()}deg)`)
    cardClone.removeClass('d-none')
    $('.action .rotate-right', cardClone).click(function () {
      imageList.empty()
      image.rotateRight()
      ImageElements.render()
    })

    $('.action .rotate-left', cardClone).click(function () {
      imageList.empty()
      image.rotateLeft()
      ImageElements.render()
    })

    $('.action .delete-card', cardClone).click(function () {
      imageList.empty()
      ImageElements.removeImage(image)
      ImageElements.render()
    })

    $('p', cardClone).html(image.getFileName())

    imageList.append(cardClone)
  }

})()

