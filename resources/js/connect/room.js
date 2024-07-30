export default function createRoom(size) {
    const data = [];

    initialize();

    function initialize() {
        for (let x = 0; x < size; x++) {
            const column = [];
            for (let y = 0; y < size; y++) {
                const tile = createTile(x, y);
                column.push(tile);
            }
            data.push(column);
        }
    }

    return {
        size,
        data
    }
}

function createTile(x, y) {
    return {
        x,
        y,
        terrainId: 'floor',
        furnitureId: undefined
    }
};
