import * as THREE from 'three';
import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader.js';

const loader = new GLTFLoader();

const assets = {
    'floor': (x, y) => {
        const floorGeometry = new THREE.BoxGeometry(1, 0.2, 1);
        const floorMaterial = new THREE.MeshStandardMaterial({ color: 0xff0000 });
        const floor = new THREE.Mesh(floorGeometry, floorMaterial);
        floor.position.set(x, 0.5, y)
        floor.userData = { id: 'floor', x, y };
        floor.receiveShadow = true; // Floor receives shadows
        return floor;
    },
    'washer': (x, y, scene, callback) => {
        loader.load('assets/connect/Starters/starters_washer.glb', function (gltf) {
            const washer = gltf.scene;
            washer.position.set(x + 0.5, 1, y + 0.5);
            washer.userData = { id: 'washer', x, y };
            washer.receiveShadow = true; // Washer receives shadows
            scene.add(washer);
            if (callback) callback(washer); // Call the callback function with the loaded object
        }, undefined, function (error) {
            console.error('An error happened while loading the washer model:', error);
            if (callback) callback(undefined); // Call the callback with undefined on error
        });
    }
}

export default function createAssetInstance(assetId, x, y, scene, callback) {
    if (assetId in assets) {
        return assets[assetId](x, y, scene, callback);
    } else {
        console.warn('Not an asset');
        return undefined;
    }
}
