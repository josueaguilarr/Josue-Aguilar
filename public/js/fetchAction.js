export default async function fetchAction(formData, currentMethod = '', controller = '', action = '') {
    let currentData;

    if (formData != null) {
        currentData = new FormData(formData);
    }

    const response = await fetch(`./Controllers/${controller}?action=${action}`, {
        method: currentMethod,
        body: currentMethod === 'GET' ? null : currentData
    })

    if (!response.ok) {
        throw new Error('Response was not ok');
    }

    const data = await response.json();
    return data;
}