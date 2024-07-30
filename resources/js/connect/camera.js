import * as THREE from 'three'
export default function initCamera(camera, room) {

    // Calculate the center of the room
    const centerX = room.size / 2;
    const centerY = room.size / 2;

    // Set the camera position for isometric view centered on the room
    const distance = room.size * 1.5; // Adjust this for zoom level
    camera.position.set(centerX + distance, distance, centerY + distance);
    camera.lookAt(centerX, 0, centerY);
}
