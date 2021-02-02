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
import Menuabsen from './Menu';
import HistoryAbsen from './History';



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
      arrayytest:['1','2'],
      Jarak:'',
      Pjarak:'',
      tes:300
    }
  }

onLayoutHEAD = event => {
    this.setState({tinggiHEAD:event.nativeEvent.layout.height+20});

  }
onScrollLayout=(e)=>{
        let y=e.nativeEvent.contentOffset.y;
        let t=this.state.tinggiHEAD;
        let x=t/y;
      if(bfore <= x){
            i=i-0.04;
            this.setState({TpScroll:'rgba(255,255,255,'+i+')'})
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
console.disableYellowBox = true;

    return (
      <View  style={styles.Backcontainer}>
      <View  style={styles.container}>
        <View onLayout={this.onLayoutHEAD}  style={styles.Textcontainer}>
              {
               <Deskripsiabsen   />
              }
                <View  style={styles.IconBox}>
                    <Svgicon key={1} name="User" />
              </View>
          </View>
        </View>
        <ScrollView onScroll={this.onScrollLayout} style={[styles.ScrollFrontContainer,{backgroundColor:this.state.TpScroll}]}>

        <View   style={[styles.Frontcontainer,{top:this.state.tinggiHEAD}]}>
        <View style={styles.container}>
              <Text style={styles.TextTitleWhite}>Ayo isi absennya!</Text>
              <View style={styles.menuContainer}>
                <Menuabsen key={2} props={this.props} />
              </View>
          </View>
          <View style={styles.container}>
                <Text  style={styles.TextTitleWhite}>History Absen</Text>
                <View style={styles.menuContainer}>
                      <HistoryAbsen key={3} />
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
    top:20,
    width:WIDTH-30,
    alignItems:'flex-start',
    // // backgroundColor:'grey',
    // borderColor:'black',
    // borderWidth:1,
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
    right:0,


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
      borderColor: 'rgba(0, 0, 0, 0.25)',
      borderTopWidth:4
    },
  menuContainer:{
    flexDirection:'row',
    flexWrap:'wrap',
    marginTop:40,
    // backgroundColor:'yellow',
    width:'100%',
    justifyContent:'center',
  },

});
