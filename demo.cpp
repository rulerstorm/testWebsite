#include <iostream>
#include <fstream>
#include <cstdlib>
#include <cstdio>
#include "MixSegment.hpp"


using namespace CppJieba;

const char * const dict_path =  "dict/jieba.dict.utf8";
const char * const model_path = "dict/hmm_model.utf8";



int main(int argc, char ** argv)
{
	const char * const test_lines = argv[1];

    MixSegment segment(dict_path, model_path);

    vector<string> words;

    segment.cut(test_lines, words);

    for(auto & i : words){
    	cout << i << endl;
    }


    return 0;
}
