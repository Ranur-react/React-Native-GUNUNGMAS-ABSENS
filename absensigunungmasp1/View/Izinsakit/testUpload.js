// Example of File Picker in React Native
// https://aboutreact.com/file-picker-in-react-native/

// Import React
import React, {useState} from 'react';
// Import required components
import {
  SafeAreaView,
  StyleSheet,
  Text,
  View,
  TouchableOpacity,
  ScrollView,
  Image,Dimensions,Svg
} from 'react-native';
import Svgicon from './../../assets/icons/Svgicon';

// Import Document Picker
import DocumentPicker from 'react-native-document-picker';
//phone Size


const {width:WIDTH} =Dimensions.get('window');
const {height:HEIGHT} =Dimensions.get('window');


const App = () => {
  const [singleFile, setSingleFile] = useState('');
  const [multipleFile, setMultipleFile] = useState([]);

  const selectOneFile = async () => {
    //Opening Document Picker for selection of one file
    try {
      const res = await DocumentPicker.pick({
        type: [DocumentPicker.types.allFiles],
        //There can me more options as well
        // DocumentPicker.types.allFiles
        // DocumentPicker.types.images
        // DocumentPicker.types.plainText
        // DocumentPicker.types.audio
        // DocumentPicker.types.pdf
      });
      //Printing the log realted to the file
      // console.log('res : ' + JSON.stringify(res));
      // console.log('URI : ' + res.uri);
      // console.log('Type : ' + res.type);
      // console.log('File Name : ' + res.name);
      // console.log('File Size : ' + res.size);
      //Setting the state to show single file attributes
      setSingleFile(res);
    } catch (err) {
      //Handling any exception (If any)
      if (DocumentPicker.isCancel(err)) {
        //If user canceled the document selection
        alert('Anda Belum mengambil Files');
      } else {
        //For Unknown Error
        alert('Unknown Error: ' + JSON.stringify(err));
        throw err;
      }
    }
  };


  return (
    <SafeAreaView style={{flex: 1}}>
                <View style={styles.Form}>
                    <Text style={styles.Label}>Upload Surat</Text>
                    <Text style={[styles.FormInput,{paddingLeft:80,color:'rgba(50,50,50,0.5)',paddingTop:12}]} onPress={selectOneFile}  > {singleFile.name ? singleFile.name : 'Klik Untuk Upload Dokumen Bukti'}  </Text>
                       <Text style={styles.NotofikasiInput}>
                   </Text>
                   <View style={[styles.Icon]}>
                   {
                     <Svgicon  name="Upload" key="1"    />
                   }
                   </View>
                 </View>
    </SafeAreaView>
  );
};

export default App;

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#fff',
    padding: 16,
  },
  Icon:{
    position: 'absolute',
    top:26,
    left:24
  },
  titleText: {
    fontSize: 22,
    fontWeight: 'bold',
    textAlign: 'center',
    paddingVertical: 20,
  },
  textStyle: {
    backgroundColor: '#fff',
    fontSize: 15,
    marginTop: 16,
    color: 'black',
  },
  buttonStyle: {
    alignItems: 'center',
    flexDirection: 'row',
    backgroundColor: '#DDDDDD',
    padding: 5,
  },
  imageIconStyle: {
    height: 20,
    width: 20,
    resizeMode: 'stretch',
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
