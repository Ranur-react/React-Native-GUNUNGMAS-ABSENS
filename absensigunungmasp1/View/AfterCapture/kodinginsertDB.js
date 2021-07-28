import {APISERVER} from './../../assets/constant/';

InserttoSQL= async()=>{

  console.log('mulai  upload');
  console.log('Data');
  console.log('Uri:'+this.state.dataImage.uri);
  console.log('name: gambar.jpeg');
    this.setState  ({loading : true })
    const data = new FormData();
    data.append('fileToUpload', {
      uri: this.state.dataImage.uri,
      type: 'image/jpeg',
        name: 'gambar.jpg',
    });
    console.log("Isi Data");
    console.log(data);
    const url= "http://114.7.96.242/eror/POLDA/Data-Analisis/USERTRIGER/tambah3.php"


  await  RNFetchBlob.fetch('POST', url, {
      Authorization: "Bearer access-token",
      otherHeader: "foo",
      'Content-Type': 'multipart/form-data',
    }, [
        { name: 'image', filename: this.state.dataImage.fileName, type: 'image/jpeg', data: this.state.dataImage.uri },
        { name: 'image_tag', data: this.state.dataImage.uri }
      ]).then((resp) => {

        console.log(resp);
        var tempMSG = resp.data;

        tempMSG = tempMSG.replace(/^"|"$/g, '');

        // Alert.alert(tempMSG);

      }).catch((err) => {
        // ...
      })




}


InserttoSQL=()=>{
  fetch("http://114.7.96.242/eror/POLDA/Data-Analisis/USERTRIGER/tambah.php", {
      method: "POST",
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json"
      },
      body: JSON.stringify({
        data: this.state.datareact,
      })
    }).then(response => response.json()).then(responseJson => {
        // Alert.alert(responseJson);
        console.log(responseJson);
      }).catch(error => {
        console.error(error);
      });

}


//insert Gambar
fetch("http://192.168.100.5/React-Native-GUNUNGMAS-ABSENS/webabsen/USERTRIGER/tambah.php", {
    method: "POST",
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json"
    },
    body: uploads,
  }).then(response => response.json()).then(responseJson => {
      // Alert.alert(responseJson);
      console.log(responseJson);
    }).catch(error => {
      console.log(error);
    });

    InserttoSQL=()=>{

      console.log('mulai upload');
      console.log('Data');
      console.log('Uri:'+this.state.dataImage.uri);
      console.log('name: gambar.jpeg');
        this.setState  ({loading : true })
        const data = new FormData();
        data.append('fileToUpload', {
          uri: this.state.dataImage.uri,
          type: 'image/jpeg',
            name: 'gambar.jpg',
        });
        console.log("Isi Data");
        console.log(data);
        const url= "http://114.7.96.242/eror/POLDA/Data-Analisis/USERTRIGER/tambah.php"
        fetch(url, {
          method: 'post',
          body: data
        })
        .then((response) => response.json())
        .then((responseJson) =>
          {
            console.log("Data Dari Server");
            console.log(responseJson);
            this.setState  ({
                loading : false
               })
          });

    }
