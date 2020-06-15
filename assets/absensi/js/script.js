const imageUpload = document.getElementById("imageUpload");

const MODEL_URL = _URL+"assets/absensi/models";
Promise.all([
  faceapi.nets.faceRecognitionNet.loadFromUri(MODEL_URL),
  faceapi.nets.faceLandmark68Net.loadFromUri(MODEL_URL),
  faceapi.nets.ssdMobilenetv1.loadFromUri(MODEL_URL),
]).then(start);
async function start() {
  console.log("Loaded");
  const labeledFaceDescriptors = await loadLableImages();
  const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors, 0.5);
  imageUpload.addEventListener("change", async () => {
    document.getElementById("container-image").innerHTML = "";
    document.getElementById("loading").innerHTML =
      '<img src = "loading/loading.gif" style="width: 200px" /><p>Uploading</p>';
    const image = await faceapi.bufferToImage(imageUpload.files[0]);

    const displaySize = direction_resize(image.width, image.height);

    const detection = await faceapi
      .detectAllFaces(image)
      .withFaceLandmarks()
      .withFaceDescriptors();

    const resize = await faceapi.resizeResults(detection, displaySize);

    const result = resize.map((d) => faceMatcher.findBestMatch(d.descriptor));

    const response_dt = await usersApi();
    const data_dt = response_dt.data;

    document.getElementById("loading").innerHTML = "";

    let contentImage =
      '<img src="' +
      image.src +
      '" style="width: ' +
      displaySize.width +
      "px; height: " +
      displaySize.height +
      'px" />';
    // console.log(image);
    let newDataQuery = '';
      // "<p style='width: 100%; margin-top: 20px; text-align: center;'>List users in photo</p>";

    result.forEach((results, index) => {
      const box = resize[index].detection.box;
      const addData = data_dt.find((itm) => {
        return itm.name == results.label;
      });
      // if (addData) {
      //   newDataQuery.push({
      //     id: addData.id,
      //     name: addData.name,
      //     image: addData.image,
      //   });
      // }
      // console.log(addData);
      // console.log(box);
      var hasil = results.toString();
      if(hasil.match('unknown')){
        hasil = 'tidak dikenali';
      }
      contentImage += `<div style="position:absolute;border:solid;border-color:red;width:${Math.round(
        box.width
      )}px;height:${Math.round(box.height)}px;top:${Math.round(
        box.y
      )}px;left:${Math.round(box.x)}px;"></div>`;

      contentImage += `<p style="position:absolute;color:#fff;background:red;width:${Math.round(
        box.width
      )}px;top:${Math.round(box.y) - 20}px;left: ${
        box.x
      }px;border:solid;border-color:red;margin-top: 0px; font-size: 12px;">${hasil}</p>`;
      if (addData) {
        newDataQuery += `<div class="user"><img src="images/${addData.image}" style='max-width: 100px; max-height: 100px;' />${addData.name}</div>`;
      }
    });

    document.getElementById("container-image").innerHTML = contentImage;
    document.getElementById("container-data").innerHTML = newDataQuery;
  });
}

function usersApi() {
  const api = axios.get(_URL+"api/perangkat/get_by_desa/"+__desa_id+"/1");
  console.log(api);
  return api;
}

async function loadLableImages() {
  const response = await usersApi();
  const data = response.data;
  return Promise.all(
    data.map(async (items) => {
      let description = [];
      const img = await faceapi.fetchImage(_URL+`images/modules/perangkat_desa/${items.id}/${items.foto}`);
      const detection = await faceapi
        .detectSingleFace(img)
        .withFaceLandmarks()
        .withFaceDescriptor();

      description.push(detection.descriptor);

      return new faceapi.LabeledFaceDescriptors(items.nama, description);
    })
  );
}

function direction_resize(width, height) {
  const variable = width > height ? width : height;

  const to = 250;
  const selisih = variable - to;
  const percent = (selisih / variable) * 100;

  const minusWidth = (width * percent) / 100;
  const minusHeight = (height * percent) / 100;

  return {
    width: width - minusWidth,
    height: height - minusHeight,
  };
}
