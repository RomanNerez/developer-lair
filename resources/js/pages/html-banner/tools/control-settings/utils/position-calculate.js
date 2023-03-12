const DEFAULT_OFFESET = 40;


function getParentSize($element) {
    const parent = $element.parent()
    const widthParent = parent.width()
    const heightParent = parent.height()

    return { widthParent, heightParent }
}

export default function getPoints($element, dataObject) {
    const { widthParent, heightParent } = getParentSize($element)

    const minLeft = 0;
    const minTop = 0;
    const maxLeft = widthParent - $element.width();
    const maxTop = heightParent - $element.height();
    
    let left = dataObject.left - DEFAULT_OFFESET;
    let top = dataObject.top - $element.height() - DEFAULT_OFFESET;

    if (left < minLeft) {
        left = minLeft;
    }

    if (left > maxLeft) {
        left = maxLeft;
    }

    if (top < minTop) {
        top = dataObject.top + dataObject.height + DEFAULT_OFFESET;
    }

    if (top > maxTop) {
        top = maxTop;
    }

    return { left, top }
}