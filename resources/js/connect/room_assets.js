import * as THREE from 'three';

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
    'block': (x, y) => {
        const floorGeometry = new THREE.BoxGeometry(1, 1, 1);
        const floorMaterial = new THREE.MeshStandardMaterial({ color: 0xffffff });
        const floor = new THREE.Mesh(floorGeometry, floorMaterial);
        floor.position.set(x, 1, y)
        floor.userData = { id: 'floor', x, y };
        floor.receiveShadow = true; // Floor receives shadows
        return floor;
    }
}

export default function createAssetInstance(assetId, x, y) {
    if (assetId in assets) {
        return assets[assetId](x, y);
    } else {
        console.warn('Not an asset');
        return undefined;
    }
}
