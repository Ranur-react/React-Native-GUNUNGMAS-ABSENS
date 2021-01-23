/* @flow */

import React, { Component } from 'react';
import {
  View,
  Text,
  StyleSheet,
  Dimensions,
  TextInput,
  Alert,
  TouchableOpacity,
  Svg,
  Keyboard,
  TouchableWithoutFeedback,
  ScrollView,
  Button
} from 'react-native';
import AsyncStorage from '@react-native-async-storage/async-storage';
import User from './../../assets/icons/user';
import Svgicon from './../../assets/icons/Svgicon';
import Deskripsiabsen from './TitleDesk';
import ImageCamera from './ImageCamera';

const {width:WIDTH} =Dimensions.get('window');
const {height:HEIGHT} =Dimensions.get('window');



export default class MyComponent extends Component {

    constructor(props) {
      super(props);
      this.state=({
          datareact:86,
          dataImage:''
        })
    }

InserttoSQL=()=>{

  console.log('mulai upload');
  console.log('Data');
  console.log('Uri:'+this.state.dataImage.uri);
  console.log('name:'+this.state.dataImage.fileName);
    this.setState  ({loading : true })
    const data = new FormData();
    data.append('fileToUpload', {
      uri: this.state.dataImage.uri,
      type: 'image/jpeg',
        name: this.state.dataImage.fileName,
    });
    const url= "http://114.7.96.242/eror/POLDA/Data-Analisis/USERTRIGER/tambah2.php"
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
  render() {
    const getDataJson = async () => {
      try {
          const jsonValue = await AsyncStorage.getItem('Json_Storage');
           const data =JSON.parse(jsonValue);
           console.log("Cetak value tersebut");
           this.setState({dataImage:data})
           console.log(this.state.dataImage);
        } catch(e) {
          Alert.alert(e);
        }
      }

    return (
      <View onLayout={getDataJson} style={styles.Backcontainer}>
        <View  style={styles.container}>
        <View  style={styles.Textcontainer}>
            <TouchableOpacity style={styles.backButton} onPress={() =>this.props.navigation.goBack()} >
              <Svgicon    name="Back" color="black" />
            </TouchableOpacity>
            <Deskripsiabsen />
            {
              <ImageCamera />
            }
          </View>
          <View style={styles.ButtonBox}>
              <TouchableOpacity onPress={this.InserttoSQL}
                style={styles.FormButton} >
                 <Text style={styles.FormButtonLable}>Simpan</Text>
             </TouchableOpacity>
             <TouchableOpacity
               style={styles.FormButtonChancel} >
                <Text style={styles.FormButtonLableChancel}>Ulangi</Text>
            </TouchableOpacity>
          </View>
        </View>
        </View>
    );
  }
}

const styles = StyleSheet.create({
  Backcontainer: {
    flex: 1,
    alignItems: 'center',
  },backButton:{
      backgroundColor:'rgba(50,50,50,0)',
      borderRadius:50,
      top:-15,
      left:-15,
      width:70,
      height:70,
      alignItems:'center',
      justifyContent:'center',
    },
  container: {
    top:20,
    width:WIDTH-30,
    alignItems:'flex-start',
    // backgroundColor:'grey',
    // borderColor:'black',
    // borderWidth:1,
  },
  Textcontainer:{
    width:'100%',
    paddingBottom:20
    // backgroundColor:'grey'
  },
  FormButtonChancel:{
    height:50,
    width:'40%',
    marginRight:60,
    backgroundColor: '#FFFFFF',
    borderColor:'#359EFF',
    borderWidth:1,
    borderRadius:50,
    alignItems:'center',
    justifyContent:'center',
    shadowColor: "rgba(0,0,0,0.25)",
    shadowOffset: {
        width: 3,
        height: 10,
    },
    shadowOpacity: 0.03,
    shadowRadius: 50,
    elevation: 2,
    },
  FormButton:{
    height:50,
    width:'40%',
    marginRight:60,
    backgroundColor: '#359EFF',
    borderRadius:50,
    alignItems:'center',
    justifyContent:'center',
    shadowColor: "rgba(0,0,0,0.25)",
    shadowOffset: {
        width: 3,
        height: 10,
    },
    shadowOpacity: 0.03,
    shadowRadius: 50,
    elevation: 2,
  },  FormButtonLable:{
      fontFamily:'Raleway-Bold',
      fontSize:20,
      color:'rgba(255,255,255,1)'
    },FormButtonLableChancel:{
      fontFamily:'Raleway-Bold',
      fontSize:20,
      color:'#359EFF'
      },
    ButtonBox:{
      // borderColor:'red',
      padding:20,
      // borderWidth:1,
      width:'100%',
      height: 80,
      flexWrap: 'wrap-reverse',
      justifyContent:'center',
    }
});
