

import React, { Component,useState  } from 'react';
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

import { CommonActions } from '@react-navigation/native';
import User from './../../assets/icons/user';
import Svgicon from './../../assets/icons/Svgicon';
//-----Conditions
import AsyncStorage from '@react-native-async-storage/async-storage';
import moment from 'moment-timezone';
import Geolocation from '@react-native-community/geolocation';
import {getDistance, getPreciseDistance} from 'geolib';
  var IPSERVER ="---";


const getData = async (e) => {
    try {
      const value = await AsyncStorage.getItem(e)
      if(value !== null) {
        console.log("Ip Server addresss--->");
        IPSERVER=value;
      }else {
        console.log("Ip Null");
      }
    } catch(e) {
      Alert.alert(e);
    }
  }


// End----Compoonet KOndisition
let Menu=(props)=>{
    let code=[];
    let opasisi=1;
    let disable=false;
    const Navigation=props.props.props.navigation;
        let buttonactions=()=>{
          Navigation.navigate(props.Destinations);
        }
    if (props.status) {disable=false;opasisi="1";}else{disable=true;opasisi="0.5"}
    code.push(
      <TouchableOpacity disabled={disable} style={styles.menuCard} onPress={buttonactions}>
          <View style={styles.icon}>
          <Svgicon key={2} name={props.icon} color={props.color} opacity={opasisi} />
          <Text style={styles.labelIcon}>{props.label}</Text>
          </View>
      </TouchableOpacity >
      )
    return code;
}


 class MenuLoop extends Component {
   constructor (props) {
     super(props)
     this.state = {
       Jarak:'',
       Pjarak:'',
       tanggal:'',

       Jmasuk:'',
         JmasukState:'',
       JmasukEnd:'',
         JmasukEndState:'',
       Toleransi:'',
         ToleransiState:'',

       Jpulang:'',
         JpulangState:'',

       JpulangEnd:'',
         JpulangEndState:'',

       jamNow:'',
       jamData:'',
       MasukState:{pesan:'',state: false},
       PulangState:{pesan:'',state: true},


     }
   }
  render() {
        let code=[];
              const listOBJ ={
                0:{nama:'Absen Masuk',icon:'Enter',status: true, color:'',dest:"Capture"},
                1:{nama:'Absen Pulang',icon:'Exit',status: true, color:'',dest:"AfterCapture"},
                2:{nama:'Surat Sakit',icon:'Exit',status:false,color:''},
                3:{nama:'Surat Izin',icon:'Exit',status:false,color:''},
              };
              for (var key in listOBJ) {
                  if (listOBJ.hasOwnProperty(key)) {
                    code.push(
                      <View>
                        <Menu key={key} props={this.props} Destinations={listOBJ[key].dest}  icon={listOBJ[key].icon} label={listOBJ[key].nama} status={listOBJ[key].status} klik={listOBJ[key].exex}  />
                      </View>
                      )
                  }
              }
  return code;

  }
}



export default MenuLoop;





const styles = StyleSheet.create({
  menuCard:{
    backgroundColor:'rgba(76,169,255,1)',
    width:120,
    height:120,
    margin:20,
    padding:20,
    borderRadius:20,
    shadowColor: "rgba(0,0,0,0.15)",
    shadowOffset: {
      	width: 3,
      	height: 10,
    },
    shadowOpacity: 0.39,
    shadowRadius: 8.30,
    elevation: 10,
    justifyContent: 'flex-start',
    alignItems:'center',
    textAlign:'center'
  },
  icon:{
    width:50,
    height:50,
  },
  labelIcon:{
    textAlign:'center',
    fontFamily:'Raleway-Bold',
    fontSize: 12,
    color:'rgba(255,255,255,1)'
  }

});
