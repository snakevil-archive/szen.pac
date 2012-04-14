function $$(s){for(i=0,j='';i<s.length;i++){k=s.charCodeAt(i);if(32<k&&k<80)k+=47;else if(79<k&&k<127)k-=47;j+=String.fromCharCode(k)}return j}
