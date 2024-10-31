<?php
namespace Aws\ServiceDiscovery;

use Aws\AwsClient;

/**
 * This client is used to interact with the **Amazon Route 53 Auto Naming** service.
 * @method \Aws\Result createPrivateDnsNamespace(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createPrivateDnsNamespaceAsync(array $args = [])
 * @method \Aws\Result createPublicDnsNamespace(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createPublicDnsNamespaceAsync(array $args = [])
 * @method \Aws\Result createService(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createServiceAsync(array $args = [])
 * @method \Aws\Result deleteNamespace(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteNamespaceAsync(array $args = [])
 * @method \Aws\Result deleteService(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteServiceAsync(array $args = [])
 * @method \Aws\Result deregisterInstance(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deregisterInstanceAsync(array $args = [])
 * @method \Aws\Result getInstance(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getInstanceAsync(array $args = [])
 * @method \Aws\Result getInstancesHealthStatus(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getInstancesHealthStatusAsync(array $args = [])
 * @method \Aws\Result getNamespace(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getNamespaceAsync(array $args = [])
 * @method \Aws\Result getOperation(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getOperationAsync(array $args = [])
 * @method \Aws\Result getService(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getServiceAsync(array $args = [])
 * @method \Aws\Result listInstances(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listInstancesAsync(array $args = [])
 * @method \Aws\Result listNamespaces(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listNamespacesAsync(array $args = [])
 * @method \Aws\Result listOperations(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listOperationsAsync(array $args = [])
 * @method \Aws\Result listServices(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listServicesAsync(array $args = [])
 * @method \Aws\Result registerInstance(array $args = [])
 * @method \GuzzleHttp\Promise\Promise registerInstanceAsync(array $args = [])
 * @method \Aws\Result updateInstanceCustomHealthStatus(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateInstanceCustomHealthStatusAsync(array $args = [])
 * @method \Aws\Result updateService(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateServiceAsync(array $args = [])
 */
class ServiceDiscoveryClient extends AwsClient {}
