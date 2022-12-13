export default function getCardImage(image) {
    return `<div class="col mb-3 d-flex justify-content-center" data-id="${image.getId()}">
        <div class="card" style="width: 18rem;">
            <img src="${image.getUrl()}">
            <div class="card-body">
                <p>${image.getFullFileName()}</p>
                <div class="input-group d-none">
                    <input type="text" class="form-control" placeholder="Название файла" required value="${image.getFileName()}">
                </div>
                <div class="size">
                    <span class="badge badge-primary">${image.width}x${image.height}</span>
                    <b>-></b>
                    <span class="badge badge-success">${image.width}x${image.height}</span>
                </div>
            </div>
            <div class="action">
                <button type="button" class="btn btn-outline-danger btn-sm delete-card">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>`
}