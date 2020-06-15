import * as faceapi from "face-api.js";
import { usersApi } from "../api/upload";

// Load models and weights
export async function loadModels() {
  const MODEL_URL = "../models";
  await faceapi.nets.faceRecognitionNet.loadFromUri(MODEL_URL);
  await faceapi.nets.faceLandmark68Net.loadFromUri(MODEL_URL);
  await faceapi.nets.ssdMobilenetv1.loadFromUri(MODEL_URL);

  console.log("loadded");
}

export async function uploadImages(imageUpload) {
  const labeledFaceDescriptors = await loadLableImages();
  const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors, 0.6);

  const image = await faceapi.bufferToImage(imageUpload);
  const displaySize = direction_resize(image.width, image.height);
  const detection = await faceapi
    .detectAllFaces(image)
    .withFaceLandmarks()
    .withFaceDescriptors();

  const resize = await faceapi.resizeResults(detection, displaySize);

  const result = resize.map((d) => faceMatcher.findBestMatch(d.descriptor));
  let newResult = [];
  result.map((item) => {
    newResult.push(item._label);
  });
  return {
    src: image.src,
    width: displaySize.width,
    height: displaySize.height,
    detection: resize,
    result: newResult,
  };
}

export const loadLableImages = async () => {
  const response = await usersApi();
  const data = response.data.data;
  return Promise.all(
    data.map(async (items) => {
      let description = [];
      const img = await faceapi.fetchImage(
        `${process.env.PUBLIC_URL}/images/${items.image}`
      );
      const detection = await faceapi
        .detectSingleFace(img)
        .withFaceLandmarks()
        .withFaceDescriptor();

      description.push(detection.descriptor);

      return new faceapi.LabeledFaceDescriptors(items.name, description);
    })
  );
};

const direction_resize = (width, height) => {
  const variable = width > height ? width : height;

  const to = 450;
  const selisih = variable - to;
  const percent = (selisih / variable) * 100;

  const minusWidth = (width * percent) / 100;
  const minusHeight = (height * percent) / 100;

  return {
    width: width - minusWidth,
    height: height - minusHeight,
  };
};
