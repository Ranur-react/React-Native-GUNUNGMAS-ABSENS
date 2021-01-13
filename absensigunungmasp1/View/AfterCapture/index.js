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
import ImageCamera from './ImageCamera';

const {width:WIDTH} =Dimensions.get('window');
const {height:HEIGHT} =Dimensions.get('window');
export default class MyComponent extends Component {

    constructor(props) {
      super(props);
    }

  render() {
    return (
      <View style={styles.Backcontainer}>
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
  }
});
