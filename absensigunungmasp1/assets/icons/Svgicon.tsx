import * as React from "react";
import Svg, { Path } from "react-native-svg";
import User from './../../assets/icons/user';
import Enter from './../../assets/icons/enter';
import Mata from './../../assets/icons/show';

let Svgicon=(prop)=>{
  let ikon=[];
      if(prop.name == 'Enter'){
        ikon.push(<Enter Color={prop.color} />)
      }else if(prop.name == 'Mata'){
        ikon.push(<Mata Color={prop.color} />)
      }else if(prop.name == 'User'){
        ikon.push(<User Color={prop.color}  />)
      }
  return ikon;
}

  export default Svgicon;
