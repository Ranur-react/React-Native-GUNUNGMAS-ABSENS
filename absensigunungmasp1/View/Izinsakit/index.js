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
import User from './../../assets/icons/user';
import Svgicon from './../../assets/icons/Svgicon';
import Deskripsiabsen from './TitleDesk';
import Camera from './Camera';
import UploadBox from './testUpload';
import DatePicker from 'react-native-datepicker';
import DateTimePicker from '@react-native-community/datetimepicker';
import DocumentPicker from 'react-native-document-picker';

const {width:WIDTH} =Dimensions.get('window');
const {height:HEIGHT} =Dimensions.get('window');


export default class Sakit extends Component {
  constructor(props){
    var a=new Date();

  super(props)
  this.state = {date:a.toISOString().slice(0,10)}
}
  render() {

    return (
      <View style={styles.Backcontainer}>
        <View   style={styles.container}>
          <TouchableOpacity style={styles.backButton} onPress={() =>console.log("muaaa")} >
          <Svgicon    name="Back" color="black" />
          </TouchableOpacity>
              <View style={styles.Title}>
                <Text onPress={() => Keyboard.dismiss()} style={styles.JudulBld}>Izin Sakit</Text>
              </View>

              <View  style={styles.FormBox}>

                    <View style={styles.Form}>
                        <Text style={styles.Label}>Tanggal</Text>
                        <DatePicker
                          style={styles.FormInput}
                          date={this.state.date}
                          mode="date"
                          placeholder="select date"
                          format="YYYY-MM-DD"
                          minDate="2018-01-01"
                          maxDate="2022-12-31"
                          confirmBtnText="Confirm"
                          cancelBtnText="Cancel"
                          customStyles={{
                           dateIcon: {
                             position: 'absolute',
                             left: 0,
                             top: 4,
                             marginLeft: 0,
                           },
                           dateInput: {
                             marginLeft: 36,
                             marginRight:240,
                             borderWidth:0,
                             top:0
                           },
                           dateText:{
                             fontFamily:'Raleway-Medium',
                             fontSize:16,
                           }
                          }}
                          onDateChange={(date) => {this.setState({date: date})}}
                          />
                           <Text style={styles.NotofikasiInput}>
                       </Text>
                     </View>
                     <View style={styles.Form}>
                         <Text style={styles.Label}>Keterangan</Text>
                         <TextInput style={styles.FormInput}  placeholder="Tulis keterangan sakit mu disini "/>
                            <Text style={styles.NotofikasiInput}>
                        </Text>
                      </View>
                      <UploadBox />
                     <TouchableOpacity
                       style={styles.FormButton} >
                        <Text style={styles.FormButtonLable}>Login</Text>
                    </TouchableOpacity>
                    <TouchableOpacity
                      style={styles.FormButtonWhite} >
                       <Text style={styles.FormButtonLable}>Login</Text>
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
  Icon:{
    position: 'absolute',
    top:26,
    left:24
  },
  container: {
    top:20,
    width:WIDTH-30,
    // backgroundColor:'grey',
    // borderColor:'black',
    // borderWidth:1,
  },
  Textcontainer:{
    width:'100%',
    paddingBottom:20
    // backgroundColor:'grey'
  },
  Title:{
      width:'100%',
      alignItems:'center',
      top:139,
    },
    JudulBld:{
      fontFamily: 'Raleway-Bold',
      fontSize: 35,
      lineHeight: 35,
  },
  FormBox:{
    position:'absolute',
    // backgroundColor: 'rgba(50,50,50,0.5)',
    width:WIDTH-30,
    top:230,
    flex:1,
    flexDirection:'column'
  },
//
  Form:{
    flex:1,
    width:'100%',
    marginBottom:15,
  },Label:{
    fontFamily: 'Raleway-Medium',
    fontSize: 12,
    lineHeight: 11.74,
    paddingLeft:20,
    paddingBottom:5,
    color:'black',
    letterSpacing:1.3,
  },FormInput:{
    height:50,
    width:'100%',
    paddingLeft:20,
    borderColor: 'rgba(0,0,0,0.5)',
    borderRadius:50,
    fontFamily:'Raleway-Medium',
    fontSize:16,
    borderWidth:1,
    borderStyle:'solid'
  },
  //
  FormButton:{
    height:50,
    width:'100%',
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
  },  FormButtonWhite:{
      height:50,
      marginTop:12,
      width:'100%',
      backgroundColor: '#FFFFFF',
      borderRadius:50,
      borderWidth:1,
      borderStyle:'solid',
      borderColor:'#359EFF',
      alignItems:'center',
      justifyContent:'center',

    },
  FormButtonLable:{
    fontFamily:'Raleway-Bold',
    fontSize:20,
    color:'rgba(255,255,255,1)'
  }


});
