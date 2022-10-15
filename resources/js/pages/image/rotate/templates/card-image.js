export default function getCardImage(image) {
    return `<div class="col mb-3 d-flex justify-content-center" data-id="${image.getId()}">
        <div class="card" style="width: 18rem;">
            <img src="${image.getUrl()}" style="transform: rotate(${image.getAngel()}deg)">
            <div class="card-body">
                <p>${image.getFullFileName()}</p>
                <div class="input-group d-none">
                    <input type="text" class="form-control" placeholder="Название файла" required value="${image.getFileName()}">
                </div>
            </div>
            <div class="action">
                <button type="button" class="btn btn-outline-secondary btn-sm rotate-right">
                    <i class="fa fa-undo" aria-hidden="true"></i>
                </button>
                <button type="button" class="btn btn-outline-secondary btn-sm rotate-left">
                    <i class="fa fa-repeat" aria-hidden="true"></i>
                </button>
                <button type="button" class="btn btn-outline-danger btn-sm delete-card">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>`
}