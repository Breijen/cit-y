import * as THREE from 'three';

import createRoom from './room.js';
import createGradientTexture from './room_background.js';
import createAssetInstance from './room_assets.js';
import initCamera from './camera.js'

const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
const renderer = new THREE.WebGLRenderer({ antialias: true });
renderer.setSize(window.innerWidth, window.innerHeight);
renderer.shadowMap.enabled = true;
document.body.appendChild(renderer.domElement);

// Variables for panning and zooming
let zoomSpeed = 1.1;

// Set gradient texture as scene background
const gradientTexture = createGradientTexture();
scene.background = gradientTexture;

const raycaster = new THREE.Raycaster();
const mouse = new THREE.Vector2();
let selectedObject = undefined;

let roomfloor = [];
let onObjectSelected = undefined; // Define it here

function initialize(room) {
    scene.clear();
    roomfloor = [];

    // Add ambient light
    const ambientLight = new THREE.AmbientLight(0xffffff, 0.5); // Soft white light
    scene.add(ambientLight);

    // Add directional light
    const directionalLight = new THREE.DirectionalLight(0xffffff, 1);
    directionalLight.position.set(5, 10, 7.5);
    directionalLight.castShadow = true;
    scene.add(directionalLight);

    // Add point light for dynamic effect
    const pointLight = new THREE.PointLight(0xffffff, 1, 100);
    pointLight.position.set(5, 5, 5);
    pointLight.castShadow = true; // Enable shadows for point light
    scene.add(pointLight);

    for (let x = 0; x < room.size; x++) {
        const column = [];
        for (let y = 0; y < room.size; y++) {
            //const terrainId = room.data[x][y].terrainId;
            const floor = createAssetInstance('floor', x, y);
            scene.add(floor);
            column.push(floor);
        }
        roomfloor.push(column);
    }
}

function onWheel(event) {
    const delta = event.deltaY > 0 ? zoomSpeed : 1 / zoomSpeed;
    camera.position.multiplyScalar(delta);
}

function onMouseDown(event) {
    mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
    mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;

    // Update the raycaster with the current mouse coordinates
    raycaster.setFromCamera(mouse, camera);

    let intersections = raycaster.intersectObjects(scene.children, false);

    if (intersections.length > 0) {
        console.log(intersections[0]);

        if (selectedObject) selectedObject.material.emissive.setHex(0);
        selectedObject = intersections[0].object;
        selectedObject.material.emissive.setHex(0x555555);

        if (onObjectSelected) { // Call onObjectSelected if it is defined
            onObjectSelected(selectedObject);
        }
    }
}

function onMouseUp() {
    // Add any logic for mouse up event here
}

function onMouseMove() {
    // Add any logic for mouse move event here
}

// Event listeners
window.addEventListener('mouseup', onMouseUp, false);
window.addEventListener('mousedown', onMouseDown, false);
window.addEventListener('mousemove', onMouseMove, false);
window.addEventListener('wheel', onWheel, false);

// Create room and initialize
const room = createRoom(10);
initialize(room);
initCamera(camera, room);

function animate() {
    requestAnimationFrame(animate);
    renderer.render(scene, camera);
}

animate();

let currentTool = 'select'; // Default tool

const tools = {
    select: 'select',
    place: 'place',
};

document.getElementById('button-selector').addEventListener('click', () => {
    currentTool = tools.select;
    console.log('Current tool:', currentTool);
});

document.getElementById('button-placer').addEventListener('click', () => {
    currentTool = tools.place;
    console.log('Current tool:', currentTool);
});

// Define the onObjectSelected function
onObjectSelected = (selectedObject) => {
    console.log(selectedObject);

    const { x, y } = selectedObject.userData;
    const tile = room.data[x][y];
    console.log(tile);

    switch (currentTool) {
        case 'select':
            handleSelectTool(tile);
            break;
        case 'place':
            handlePlaceTool(tile, x, y);
            break;
        default:
            console.log('Unknown tool selected');
    }
};

// Handle select tool logic
function handleSelectTool(tile) {
    if (tile.furnitureId) {
        console.log(tile.furnitureId);
    } else {
        console.log("No furniture here");
    }
}

// Handle place tool logic
function handlePlaceTool(tile, x, y) {
    if (tile.furnitureId) {
        console.log(tile.furnitureId);
    } else {
        const newFurniture = createAssetInstance('block', x, y);
        scene.add(newFurniture);
        // Update the tile data to reflect the new furniture
        tile.furnitureId = newFurniture.id;
        console.log('Placed new furniture at', x, y);
    }
}
