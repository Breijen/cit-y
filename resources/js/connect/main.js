import * as THREE from 'three';

const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
const renderer = new THREE.WebGLRenderer({ antialias: true });
renderer.setSize(window.innerWidth, window.innerHeight);
renderer.shadowMap.enabled = true; 
document.body.appendChild(renderer.domElement);

// Add ambient light
const ambientLight = new THREE.AmbientLight(0x404040, 1.5);
scene.add(ambientLight);

// Add directional light
const directionalLight = new THREE.DirectionalLight(0xffffff, 1.0);
directionalLight.position.set(1, 3, 3).normalize();
directionalLight.castShadow = true; // Enable shadows for directional light
scene.add(directionalLight);

// Add point light for dynamic effect
const pointLight = new THREE.PointLight(0xffffff, 1, 100);
pointLight.position.set(5, 5, 5);
pointLight.castShadow = true; // Enable shadows for point light
scene.add(pointLight);

// Create gradient texture using canvas
function createGradientTexture() {
    const canvas = document.createElement('canvas');
    canvas.width = 512;
    canvas.height = 512;
    const context = canvas.getContext('2d');

    // Create gradient
    const gradient = context.createRadialGradient(
        canvas.width / 2, canvas.height / 2, 0,
        canvas.width / 2, canvas.height / 2, canvas.width / 2
    );
    gradient.addColorStop(0, '#637857'); // center color
    gradient.addColorStop(1, '#2B3631'); // edge color

    // Fill with gradient
    context.fillStyle = gradient;
    context.fillRect(0, 0, canvas.width, canvas.height);

    return new THREE.CanvasTexture(canvas);
}

// Set gradient texture as scene background
const gradientTexture = createGradientTexture();
scene.background = gradientTexture;

// Create grid floor
const gridSize = 10;
const gridDivisions = 10;
const gridHelper = new THREE.GridHelper(gridSize, gridDivisions);
gridHelper.position.x = 0.15
gridHelper.position.y = 0.15; // Align grid with the top of the floor
gridHelper.position.z = 0.15
scene.add(gridHelper);

// Floor
const floorGeometry = new THREE.BoxGeometry(10, 10, 0.3);
const floorMaterial = new THREE.MeshStandardMaterial({ color: 0x808080 });
const floor = new THREE.Mesh(floorGeometry, floorMaterial);
floor.rotation.x = -Math.PI / 2;
floor.position.x = 0.15
floor.position.z = 0.15
floor.receiveShadow = true; // Floor receives shadows
scene.add(floor);

// Walls
const wallMaterial = new THREE.MeshStandardMaterial({ color: 0xffffff });
const wallGeometry = new THREE.BoxGeometry(10.3, 5.3, 0.3);

const backWall = new THREE.Mesh(wallGeometry, wallMaterial);
backWall.position.z = -5;
backWall.position.y = 2.5;
backWall.receiveShadow = true;
scene.add(backWall);

const leftWall = new THREE.Mesh(wallGeometry, wallMaterial);
leftWall.rotation.y = Math.PI / 2;
leftWall.position.x = -5;
leftWall.position.y = 2.5;
leftWall.receiveShadow = true;
scene.add(leftWall);

// Camera setup for isometric view
camera.position.set(10, 10, 10);
camera.lookAt(0, 0, 0);

// Variables for panning and zooming
let zoomSpeed = 1.1;

function onWheel(event) {
    const delta = event.deltaY > 0 ? zoomSpeed : 1 / zoomSpeed;
    camera.position.multiplyScalar(delta);
}

window.addEventListener('wheel', onWheel, false);

// Function to add a cube at a specific grid position
function addCubeToGrid(gridX, gridY, color = 0x8B4513) {
    const size = gridSize / gridDivisions;
    const boxGeometry = new THREE.BoxGeometry(size, size, size);
    const boxMaterial = new THREE.MeshStandardMaterial({ color: color });
    const box = new THREE.Mesh(boxGeometry, boxMaterial);
    box.position.set(gridX * size - (gridSize / 2 - size / 2), size / 2, gridY * size - (gridSize / 2 - size / 2));
    box.castShadow = true; // Box casts shadows
    box.receiveShadow = true; // Box receives shadows
    scene.add(box);
}

function animate() {
    requestAnimationFrame(animate);
    renderer.render(scene, camera);
}

animate();
