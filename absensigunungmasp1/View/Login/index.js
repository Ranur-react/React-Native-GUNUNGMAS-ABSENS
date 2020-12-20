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
  TouchableWithoutFeedback
} from 'react-native';
import SvgComponent from './../../assets/icons/show';
const {width:WIDTH} =Dimensions.get('window');


export default class Login extends Component {
  state={
    email:'',
    paswd:'',
    showPassword:true,
    mailNotifikasi:'',
    paswdNotifikasi:'',

  }

  constructor(){
    super()
  }
  render() {
    let onPress=()=>{
     a=32
   }
//Password Hidden Toggle
   let PasswordShowTougle=()=>{
     if(this.state.showPassword == true){
        this.setState({showPassword:false})
     }else{
       this.setState({showPassword:true})

     }

   };

//Input E-mail validasi Toogle
let EmailInputTougle=()=>{
  if(this.state.email.includes("@")){
    this.setState({mailNotifikasi:""})
  }else{
    this.setState({mailNotifikasi:'Input format e-mail dengan benar'})

  }
}

//Input Password validasi Toogle

let paswdInputTougle=()=>{
  setInterval(()=>{ this.setState({showPassword:true})
    },30000);
var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})"); //Angka , Simbol dan Huruf
var passw=  /^[A-Za-z]\w{7,14}$/;  //Angka dan Huruf
alph=  /^[A-Za-z]+$/; //Angka kecil dan Besar
a=this.state.paswd.length;
pas=this.state.paswd;
      if(a >= 8){
        if(strongRegex.test(pas)){
          this.setState({paswdNotifikasi:"bisaa"})

        }else{
          this.setState({paswdNotifikasi:' Password harus terdiri dari symbol(*&^$@!&) dan Angka (9-0)'})
        }
      }else{
        this.setState({paswdNotifikasi:' Password Minimal 8 karakter'})
      }
}

//hide/show keyboard kompone

    return (
      <TouchableWithoutFeedback   onPress={() => Keyboard.dismiss()}>
          <View  style={styles.container}>
            <View style={styles.Title}>
              <Text onPress={() => Keyboard.dismiss()} style={styles.JudulBld}>Login dulu ya!</Text>
            </View>
            <View style={styles.FormBox}>
                   <View style={styles.Form}>
                       <Text style={styles.Label}>Username</Text>
                      <TextInput style={styles.FormInput} onBlur={EmailInputTougle} onChangeText={e=>this.setState({email:e})} value={this.state.email} placeholder="E-mail "/>
                      <Text style={styles.NotofikasiInput}>
                      {this.state.mailNotifikasi}
                      </Text>
                    </View>
                    <View style={styles.Form}>
                    <Text style={styles.Label}>Password</Text>

                       <TextInput style={styles.FormInput} onBlur={paswdInputTougle} onChangeText={e=>this.setState({paswd:e})} value={this.state.paswd} secureTextEntry={this.state.showPassword}  placeholder="Password"/>
                                   <TouchableOpacity onPress={PasswordShowTougle}  style={styles.FromImageIcon} >
                                      <SvgComponent />
                                   </TouchableOpacity>
                       <Text style={styles.NotofikasiInput}>
                       {this.state.paswdNotifikasi}
                       </Text>
                     </View>
                       <TouchableOpacity
                         style={styles.FormButton}
                         onPress={onPress}>
                          <Text style={styles.FormButtonLable}>Login</Text>
                      </TouchableOpacity>
             </View>
          </View>
      </TouchableWithoutFeedback>
    );
  }
}







const styles = StyleSheet.create({
  container: {
    flex: 1,
    alignItems: 'center',

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
},FormBox:{
  position:'absolute',
  // backgroundColor: 'rgba(50,50,50,0.5)',
  width:WIDTH-55,
  top:230,
  flex:1,
  flexDirection:'column'
},Form:{
  flex:1,
  width:'100%',
  marginBottom:25,


}
,FormInput:{
  height:50,
  width:'100%',
  paddingLeft:20,
  borderColor: 'rgba(0,0,0,0.5)',
  borderRadius:50,
  fontFamily:'Raleway',
  fontSize:16,
  borderWidth:1,
  borderStyle:'solid'
},
FromImageIcon:{
  position:'absolute',
  padding:10,
  height:50,
  width:'13%',
  right:3,
  borderRadius:50,
  alignItems:'center',
  justifyContent:'center'


},
FormButton:{
  height:50,
  width:'100%',
  backgroundColor: '#359EFF',
  borderRadius:50,
  alignItems:'center',
  justifyContent:'center',
      shadowColor: 'rgba(46, 229, 157, 0.4)',
      shadowOpacity: 1.5,
shadowOffset : { width: 1, height: 13},
},FormButtonLable:{
  fontFamily:'Raleway-Bold',
  fontSize:20,
  color:'rgba(255,255,255,1)'
},NotofikasiInput:{
  color:'#FE4102',
  paddingLeft:20
},Label:{
  fontFamily: 'Raleway',
  fontSize: 10,
  lineHeight: 11.74,
  paddingLeft:20,
  paddingBottom:5,
  fontWeight:"400",
  color:'black',
  letterSpacing:1.3,
}



});
