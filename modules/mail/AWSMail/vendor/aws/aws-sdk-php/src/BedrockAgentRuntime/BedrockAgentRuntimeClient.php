<?php
namespace Aws\BedrockAgentRuntime;

use Aws\AwsClient;

/**
 * This client is used to interact with the **Agents for Amazon Bedrock Runtime** service.
 * @method \Aws\Result createInvocation(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createInvocationAsync(array $args = [])
 * @method \Aws\Result createSession(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createSessionAsync(array $args = [])
 * @method \Aws\Result deleteAgentMemory(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteAgentMemoryAsync(array $args = [])
 * @method \Aws\Result deleteSession(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteSessionAsync(array $args = [])
 * @method \Aws\Result endSession(array $args = [])
 * @method \GuzzleHttp\Promise\Promise endSessionAsync(array $args = [])
 * @method \Aws\Result generateQuery(array $args = [])
 * @method \GuzzleHttp\Promise\Promise generateQueryAsync(array $args = [])
 * @method \Aws\Result getAgentMemory(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getAgentMemoryAsync(array $args = [])
 * @method \Aws\Result getExecutionFlowSnapshot(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getExecutionFlowSnapshotAsync(array $args = [])
 * @method \Aws\Result getFlowExecution(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getFlowExecutionAsync(array $args = [])
 * @method \Aws\Result getInvocationStep(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getInvocationStepAsync(array $args = [])
 * @method \Aws\Result getSession(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getSessionAsync(array $args = [])
 * @method \Aws\Result invokeAgent(array $args = [])
 * @method \GuzzleHttp\Promise\Promise invokeAgentAsync(array $args = [])
 * @method \Aws\Result invokeFlow(array $args = [])
 * @method \GuzzleHttp\Promise\Promise invokeFlowAsync(array $args = [])
 * @method \Aws\Result invokeInlineAgent(array $args = [])
 * @method \GuzzleHttp\Promise\Promise invokeInlineAgentAsync(array $args = [])
 * @method \Aws\Result listFlowExecutionEvents(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listFlowExecutionEventsAsync(array $args = [])
 * @method \Aws\Result listFlowExecutions(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listFlowExecutionsAsync(array $args = [])
 * @method \Aws\Result listInvocationSteps(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listInvocationStepsAsync(array $args = [])
 * @method \Aws\Result listInvocations(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listInvocationsAsync(array $args = [])
 * @method \Aws\Result listSessions(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listSessionsAsync(array $args = [])
 * @method \Aws\Result listTagsForResource(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listTagsForResourceAsync(array $args = [])
 * @method \Aws\Result optimizePrompt(array $args = [])
 * @method \GuzzleHttp\Promise\Promise optimizePromptAsync(array $args = [])
 * @method \Aws\Result putInvocationStep(array $args = [])
 * @method \GuzzleHttp\Promise\Promise putInvocationStepAsync(array $args = [])
 * @method \Aws\Result rerank(array $args = [])
 * @method \GuzzleHttp\Promise\Promise rerankAsync(array $args = [])
 * @method \Aws\Result retrieve(array $args = [])
 * @method \GuzzleHttp\Promise\Promise retrieveAsync(array $args = [])
 * @method \Aws\Result retrieveAndGenerate(array $args = [])
 * @method \GuzzleHttp\Promise\Promise retrieveAndGenerateAsync(array $args = [])
 * @method \Aws\Result retrieveAndGenerateStream(array $args = [])
 * @method \GuzzleHttp\Promise\Promise retrieveAndGenerateStreamAsync(array $args = [])
 * @method \Aws\Result startFlowExecution(array $args = [])
 * @method \GuzzleHttp\Promise\Promise startFlowExecutionAsync(array $args = [])
 * @method \Aws\Result stopFlowExecution(array $args = [])
 * @method \GuzzleHttp\Promise\Promise stopFlowExecutionAsync(array $args = [])
 * @method \Aws\Result tagResource(array $args = [])
 * @method \GuzzleHttp\Promise\Promise tagResourceAsync(array $args = [])
 * @method \Aws\Result untagResource(array $args = [])
 * @method \GuzzleHttp\Promise\Promise untagResourceAsync(array $args = [])
 * @method \Aws\Result updateSession(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateSessionAsync(array $args = [])
 */
class BedrockAgentRuntimeClient extends AwsClient {}
