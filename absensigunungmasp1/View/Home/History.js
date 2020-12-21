/* @flow weak */

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
  Button,
  Image
} from 'react-native';



import User from './../../assets/icons/user';
import Svgicon from './../../assets/icons/Svgicon';

class ClassHIstory extends Component{
  constructor (props) {
    super(props)
    this.state = {
        Sourcelink:{
          link1:'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80',
          link2:''
        }
    }
  }
  render(){
    return(
      <View>
        <TouchableOpacity style={styles.HistoryCard}>
            <Image style={styles.ImageCapture} source={{uri:this.state.Sourcelink.link1}} />
            <Text style={styles.Title}> Absensi Pulang </Text>
            <Text style={styles.label}> 06 November 2020 </Text>
            <Text style={styles.label}> 08.33 </Text>
        </TouchableOpacity >
      </View>
    )
  }
}


let HistoryLoop=()=>{
  for (var i = 0; i < array.length; i++) {
    array[i]
  }
  return()
}


export default ClassHIstory;

const styles = StyleSheet.create({
  HistoryCard:{
    backgroundColor:'rgba(92,177,255,1)',
    width:370,
    height:91,
    margin:20,
    padding:15.5,
    borderRadius:20,
    shadowColor: "rgba(0,0,0,0.05)",
    shadowOffset: {
      	width: 0.1,
      	height: 0.1,
    },
    shadowOpacity: 0,
    shadowRadius: 1.30,
    elevation: 1,
    justifyContent: 'flex-start',
    alignItems:'flex-start',
    textAlign:'center',
    flexDirection:'column',
    flexWrap:'wrap',
  },
  ImageCapture:{
    height: 60,
    width: 60,
    borderRadius: 10,
    marginRight: 16
  },

  Title:{
    textAlign:'center',
    fontFamily:'Raleway-Bold',
    fontSize: 15,
    color:'rgba(255,255,255,1)'
  },label:{
    textAlign:'center',
    fontFamily:'Raleway',
    fontSize: 13,
    fontWeight:'100',
    color:'rgba(255,255,255,1)'
  }

});
