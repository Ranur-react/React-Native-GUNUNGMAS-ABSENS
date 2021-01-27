import * as React from "react";
import Svg, { Path } from "react-native-svg";
import User from './../../assets/icons/user';
import Enter from './../../assets/icons/enter';
import Mata from './../../assets/icons/show';
import Back from './../../assets/icons/back';
import Camera from './../../assets/icons/Camera';
import Calenders from './../../assets/icons/Calenders';
import Upload from './../../assets/icons/Upload';
import Exit from './../../assets/icons/exit';

let Svgicon=(prop)=>{
  let ikon=[];
      if(prop.name == 'Enter'){
        ikon.push(<Enter op={prop.opacity} Color={prop.color} />)
      }else if(prop.name == 'Mata'){
        ikon.push(<Mata op={prop.opacity} Color={prop.color} />)
      }else if(prop.name == 'User'){
        ikon.push(<User op={prop.opacity} Color={prop.color}  />)
      }else if(prop.name == 'Back'){
        ikon.push(<Back op={prop.opacity} Color={prop.color}  />)
      }else if(prop.name == 'Camera'){
        ikon.push(<Camera op={prop.opacity} Color={prop.color}  />)
      }else if(prop.name == 'Kalender'){
        ikon.push(<Calenders op={prop.opacity} Color={prop.color}  />)
      }else if(prop.name == 'Upload'){
        ikon.push(<Upload op={prop.opacity} Color={prop.color}  />)
      }else if(prop.name == 'Exit'){
        ikon.push(<Exit Color={prop.color} op={prop.opacity}  />)
      }
  return ikon;
}

  export default Svgicon;
