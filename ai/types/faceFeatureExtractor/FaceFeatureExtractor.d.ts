import * as tf from '../../dist/tfjs.esm';
import { NetInput, TNetInput } from '../dom/index';
import { NeuralNetwork } from '../NeuralNetwork';
import { FaceFeatureExtractorParams, IFaceFeatureExtractor } from './types';
export declare class FaceFeatureExtractor extends NeuralNetwork<FaceFeatureExtractorParams> implements IFaceFeatureExtractor<FaceFeatureExtractorParams> {
    constructor();
    forwardInput(input: NetInput): tf.Tensor4D;
    forward(input: TNetInput): Promise<tf.Tensor4D>;
    protected getDefaultModelName(): string;
    protected extractParamsFromWeightMap(weightMap: tf.NamedTensorMap): {
        params: FaceFeatureExtractorParams;
        paramMappings: import("../common/types").ParamMapping[];
    };
    protected extractParams(weights: Float32Array): {
        params: FaceFeatureExtractorParams;
        paramMappings: import("../common/types").ParamMapping[];
    };
}