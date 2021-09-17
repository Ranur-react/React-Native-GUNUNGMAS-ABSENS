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
import Enter from './../../assets/icons/enter';
import Svgicon from './../../assets/icons/Svgicon';

const {width:WIDTH} =Dimensions.get('window');
const {height:HEIGHT} =Dimensions.get('window');
let i=0;
let bfore=0;
export default class Home extends Component {
  constructor (props) {
    super(props)
    this.state = {
      data:undefined,
      TpScroll:'',
      arrayytest:['Mata','Enter']
    }
  }

onLayoutHEAD = event => {
    this.setState({tinggiHEAD:event.nativeEvent.layout.height+20})
  }
onScrollLayout=(e)=>{
  let y=e.nativeEvent.contentOffset.y;
  let t=this.state.tinggiHEAD;
  let x=t/y;
//
if(bfore <= x){
      i=i-0.04;
      this.setState({TpScroll:'rgba(255,255,255,'+i+')'})
      // console.log("Nilai Before UP: "+bfore+"Nilai x:"+x+"Nilai i"+i);
}
else{
  i=i+0.04;
      this.setState({TpScroll:'rgba(255,255,255,'+i+')'})
}
bfore=x;
if(y==0){
  i=0;
    this.setState({TpScroll:'rgba(255,255,255,0)'})
}



}
  render() {


let testCall=()=>{
  console.log("Bisa..");
}
let MenuFromdata=(props)=>{
    return(
      <View style={styles.menuCard}>
          <TouchableOpacity style={styles.icon}>
          <Svgicon IconName={props.Namicon} />
          <Text style={styles.labelIcon}>Absen Masuk</Text>
          </TouchableOpacity>
      </View>
      )
}


let LoopMenuData=()=>{

      let rows = [];
        for (let i = 0; i < 1; i++) {
          rows.push(
            <View style={styles.menuCard}>
                <TouchableOpacity  style={styles.icon}>
                <Svgicon IconName="Enter" />
                <Text style={styles.labelIcon}>Absen Masuk</Text>
                </TouchableOpacity>
            </View>
            );
        }
      return rows;
}
    return (
      <View style={styles.Backcontainer}>
      <View  style={styles.container}>
        <View onLayout={this.onLayoutHEAD}  style={styles.Textcontainer}>
                <Text onPress={testCall} style={styles.TextTitle}>Absensi Hari Ini:</Text>
                <Text style={styles.TextBody}>Sabtu,07 November 2020</Text>
                <Text style={styles.TextBody}>Jam Masuk: 08.00 - 09.00</Text>
                <Text style={styles.TextBody}>Jam Pulang: 16.00 - 20.00</Text>
                <Text style={styles.TextTitle}>Lokasi Absensi: </Text>
                <Text style={styles.TextBody}>
                Jl.Adinegoro No.9,</Text>
                <Text style={styles.TextBody}>Tabing,Kec.Koto Tangah,Kota Padang</Text>
                <View style={styles.IconBox}>
                    <User />
              </View>
          </View>
        </View>
        <ScrollView onScroll={this.onScrollLayout} style={[styles.ScrollFrontContainer,{backgroundColor:this.state.TpScroll}]}>

        <View   style={[styles.Frontcontainer,{top:this.state.tinggiHEAD}]}>
        <View style={styles.container}>
              <Text onPress={testCall} style={styles.TextTitleWhite}>Ayo isi absennya!</Text>
              <View style={styles.menuContainer}>
                  <View style={styles.menuCard}>
                      <TouchableOpacity style={styles.icon}>
                      <Svgicon key="" IconName="Mata" />
                      <Text style={styles.labelIcon}>Absen Masuk</Text>
                      </TouchableOpacity>
                  </View>
              </View>
          </View>
        </View>
        </ScrollView>
      </View>
    );
  }

}

const styles = StyleSheet.create({
  Backcontainer: {
    flex: 1,
    alignItems: 'center',
  },
  container: {
    flex: 1,
    top:20,
    width:WIDTH-30,
    alignItems:'flex-start',
    height:300
  },
  Textcontainer:{
    width:'100%',
    paddingBottom:20
    // backgroundColor:'grey'
  },
  TextTitle:{
    fontFamily:'Raleway-Bold',
    fontSize: 20,
    lineHeight: 40,
    color:'rgba(0,0,0,1)'
  },
  TextTitleWhite:{
    fontFamily:'Raleway-Bold',
    fontSize: 20,
    lineHeight: 40,
    color:'rgba(255,255,255,1)'
  }
  ,TextBody:{
    fontFamily:'Raleway',
    fontSize: 15,
    lineHeight: 20,
    color:'rgba(0,0,0,5)'
  },
  IconBox:{
    position:'absolute',
    width:50,
    height:50,
    right:0
  },
  ScrollFrontContainer:{
    flex:1,
    position:'absolute',
    flexDirection:'column',
    width:WIDTH,
    height:HEIGHT,
    // opacity:0.9
  },
  Frontcontainer: {
      flex: 1,
      backgroundColor: 'rgba(53,158,255,1)',
      alignItems: 'center',
      width:WIDTH,
      height:1346,
      borderTopLeftRadius:40,
      borderTopRightRadius:40,
    },
  menuContainer:{
    flexDirection:'row-reverse',
    marginTop:40,
    // backgroundColor:'grey',
    width:'100%',
    height:300,
    justifyContent:'center',
  },
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
    fontSize: 15,
    color:'rgba(255,255,255,1)'
  }
});
