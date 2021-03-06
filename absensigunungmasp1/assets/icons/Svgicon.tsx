import * as React from "react";
import Svg, { Path } from "react-native-svg";
import User from './../../assets/icons/user';
import Enter from './../../assets/icons/enter';
import Mata from './../../assets/icons/show';
import Back from './../../assets/icons/back';
import Camera from './../../assets/icons/Camera';
import Calenders from './../../assets/icons/Calenders';
import Upload from './../../assets/icons/Upload';

let Svgicon=(prop)=>{
  let ikon=[];
      if(prop.name == 'Enter'){
        ikon.push(<Enter Color={prop.color} />)
      }else if(prop.name == 'Mata'){
        ikon.push(<Mata Color={prop.color} />)
      }else if(prop.name == 'User'){
        ikon.push(<User Color={prop.color}  />)
      }else if(prop.name == 'Back'){
        ikon.push(<Back Color={prop.color}  />)
      }else if(prop.name == 'Camera'){
        ikon.push(<Camera Color={prop.color}  />)
      }else if(prop.name == 'Kalender'){
        ikon.push(<Calenders Color={prop.color}  />)
      }else if(prop.name == 'Upload'){
        ikon.push(<Upload Color={prop.color}  />)
      }
  return ikon;
}

  export default Svgicon;
