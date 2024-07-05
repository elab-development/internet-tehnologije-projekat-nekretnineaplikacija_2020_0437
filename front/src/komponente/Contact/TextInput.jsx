import React from 'react';

const TextInput = ({ value, onChange, ...props }) => {
  return (
    <input
      type="text"
      value={value}
      onChange={onChange}
      {...props}  
    />
  );
};

export default TextInput;
