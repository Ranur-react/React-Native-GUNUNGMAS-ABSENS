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
