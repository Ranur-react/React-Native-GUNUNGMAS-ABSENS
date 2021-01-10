
import React, { Component } from 'react';
import {
  View,
  Text,
  StyleSheet,
  Dimensions,
  TextInput,
  Alert,
  TouchableOpacity,
  TouchableHighLight,
  Svg,
  Keyboard,
  TouchableWithoutFeedback,
  ScrollView,
  Button
} from 'react-native';
import Svgicon from './../../assets/icons/Svgicon';
import DateTimePicker from '@react-native-community/datetimepicker';



let ShowKalender=()=>{
    return(
      <View  >
          <DateTimePicker  onChange={this.setDate}
            textColor="red"
           value={Date.now()} />
      </View>
    )
}
let ModalState=()=>{
if(this.state.DpickerState==true){
    return(
      <ShowKalender />
    )
  }else{
    return(
      <View>
          <Text> Belum
          </Text>
      </View>
    )
  }
        }

export default class MyComponent extends Component {
  constructor(props){
  super(props)
  this.state = {
    date:"mm/dd/yy",
    DpickerState:'false'
  }
}
// setDate = (event, date) => {
//   var n = date.toISOString().slice(0,10);
//   this.setState({ date:n
//               })
// }

  render() {
    console.log("Cetak");

    return (
        <View   style={styles.Form}>
            <Text style={styles.Label}>Username</Text>
               <Text onPress={()=>{console.log("Cetak")}}  style={styles.FormInputDate} >
               {
                 this.state.date
               }
               </ Text>
               <Text style={styles.NotofikasiInput}>{

                 // <ModalState />

               }</Text>
           <View style={styles.Icon}>
           {

             // <Svgicon  name="Kalender" key="1"    />
           }
           </View>
         </View >
    );
  }
}

const styles = StyleSheet.create({
  Icon:{
    position: 'absolute',
    top:21,
    left:23
  },
  Form:{
    flex:1,
    width:'100%',
    marginBottom:15,
    // backgroundColor: 'grey'
  },Label:{
    fontFamily: 'Raleway-Medium',
    fontWeight:"400",
    fontSize: 12,
    lineHeight: 11.74,
    paddingLeft:20,
    paddingBottom:5,
    color:'black',
    letterSpacing:1.3,
  },FormInputDate:{
    height:50,
    width:'100%',
    paddingLeft:20,
    borderColor: 'rgba(0,0,0,0.5)',
    borderRadius:50,
    fontFamily:'Raleway-Medium',
    fontSize:20,
    borderWidth:1,
    borderStyle:'solid',
    paddingLeft: 70,
    lineHeight: 50

  }
});
