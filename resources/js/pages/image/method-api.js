import axios from "axios";

export async function previewImage(dataObject) {
    const { data } = await axios.post(
        '/image/preview',
        dataObject,
        { responseType: 'blob' }
    )
    return data
}

export async function generateImage(dataObject) {
    const data = await axios.post('/image/generate', dataObject, { responseType: 'blob' })
    return data
}